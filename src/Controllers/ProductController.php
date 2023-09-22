<?php
namespace Controllers;

use Helpers\FlashMessageHelper;
use Models\Product;
use Models\User;

class ProductController
{
    private Product $productModel;
    private User $userModel;

    public function __construct(Product $productModel, User $userModel)
    {
        $this->productModel = $productModel;
        $this->userModel = $userModel;
    }

    public function showProductDetails($productId): void
    {
        // Get the product details from the database.
        $product = $this->productModel->getProductById($productId);

        // Check if the product exists.
        if (!$product) {
            header('Location: /404');
            exit;
        }

        // Get the user who created the product.
        $userId = $product['user_id'];
        $user = $this->userModel->getUserById($userId);

        // Get the image paths from the product.
        $imagePaths = json_decode($product['image_path'], true);

        $imagePaths = array_map(function ($imagePath) {
            return '/assets/images/' . $imagePath;
        }, $imagePaths);

        // Render the view with the header and footer included.
        include __DIR__ . '/../templates/header.php';
        // Render the view for the product details page.
        include __DIR__ . '/../templates/user/products/product-details.php';
        include __DIR__ . '/../templates/footer.php';
    }

    public function createProduct(): void
    {
        // Check if the user is logged in.
        if (!isset($_SESSION['user'])) {
            FlashMessageHelper::setFlashMessage('error', 'You must be logged in to create a product.');
            header('Location: /');
            exit;
        }

        // Get the logged-in user's ID.
        $userId = $_SESSION['user']['id'];

        // Handle the form submission to create a product.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the form data.
            $productName = $_POST['product_name'];
            $productDescription = $_POST['product_description'];
            $productPublicationDate = $_POST['product_publication_date'];
            // Handle single or multiple images.
            $productImages = $_FILES['product_images'];
            $uploadedImagesLength = strlen($productImages['name'][0]);

            // Validate the required fields.
            if (empty($productName) ||
                empty($productDescription) ||
                empty($productPublicationDate) ||
                ($uploadedImagesLength === 0)) {
                FlashMessageHelper::setFlashMessage('error', 'Product name, description, publication date, and image are mandatory fields.');
                header('Location: /create-product');
                exit;
            }

            // Save the product to the database.
            $productImagesNames = $this->handleProductImages($productImages);
            $this->productModel->saveProduct($userId, $productName, $productDescription, $productPublicationDate, $productImagesNames);

            // Set a session variable to indicate the success status.
            $_SESSION['createProductSuccess'] = true;

            // Redirect to a different page to prevent form resubmission.
            header('Location: /create-product-success');
            exit;
        }
        $hideLoginOption = isset($user);
        // Get the user's name.
        $user = $_SESSION['user'];

        // Render the view with the header and footer included.
        include __DIR__ . '/../templates/header.php';
        include __DIR__ . '/../partials/flash-message.php';
        // Render the view to create a product.
        include __DIR__ . '/../templates/user/products/create-product.php';
        include __DIR__ . '/../templates/footer.php';
    }

    public function createProductSuccess(): void
    {
        // Check if the editContactSuccess session variable is set to true.
        if (!isset($_SESSION['createProductSuccess']) || !$_SESSION['createProductSuccess']) {
            header('Location: /');
            exit;
        }

        // Unset the editContactSuccess session variable.
        unset($_SESSION['createProductSuccess']);
        $hideLoginOption = isset($user);
        $user = $_SESSION['user'];

        // Render the view with the header and footer included.
        include __DIR__ . '/../templates/header.php';
        // Render the view for the edit contact success page.
        include __DIR__ . '/../templates/user/products/create-product-success.php';
        include __DIR__ . '/../templates/footer.php';
    }

    public function editProduct(): void
    {
        // Check if the user is logged in.
        if (!isset($_SESSION['user'])) {
            FlashMessageHelper::setFlashMessage('error', 'You must be logged in to edit a product.');
            header('Location: /');
            exit;
        }

        // Get the logged-in user's ID.
        $userId = $_SESSION['user']['id'];

        // Get the product ID from the request.
        $productId = $_GET['id'] ?? null;

        // Check if the product ID is provided.
        if (!$productId) {
            FlashMessageHelper::setFlashMessage('error', 'Product ID is missing.');
            header('Location: /');
            exit;
        }

        // Get the product details from the database.
        $product = $this->productModel->getProductById($productId);

        // Check if the product exists and belongs to the logged-in user.
        if (!$product || $product['user_id'] !== $userId) {
            header('Location: /404');
            exit;
        }

        // Handle the form submission to update the product.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the form data.
            $productName = $_POST['product_name'];
            $productDescription = $_POST['product_description'];
            $productPublicationDate = $_POST['product_publication_date'];
            // Handle single or multiple images.
            $productImages = $_FILES['product_images'];
            $uploadedImagesLength = strlen($productImages['name'][0]);

            // Get the existing image names from the database.
            $existingImages = json_decode($product['image_path'], true);

            // Remove the keys from the existing images array.
            $existingImages = array_values($existingImages);

            // Check if there is only one image left and no new images were uploaded.
            if (count($existingImages) === 1 && empty($_FILES['product_images']['name'][0])) {
                FlashMessageHelper::setFlashMessage('error', 'Cannot delete the last image. A product must have at least one image.');
                header('Location: /edit-product?id=' . $productId);
                exit;
            }

            // Validate the required fields.
            if (empty($productName) ||
                empty($productDescription) ||
                empty($productPublicationDate) ||
                ($uploadedImagesLength === 0 &&
                empty($existingImages))) {

                FlashMessageHelper::setFlashMessage('error', 'Product name, description, publication date, and image are mandatory fields.');
                header('Location: /edit-product?id=' . $productId);
                exit;
            }

            // Check if new images were uploaded.
            if (!empty($productImages['name'][0])) {
                // Handle the new images and merge them with the existing images.
                $newImages = $this->handleProductImages($productImages);
                $productImagesNames = array_merge($existingImages, $newImages);
            } else {
                // No new images were uploaded, keep the existing images.
                $productImagesNames = $existingImages;
            }

            // Remove selected images from the database.
            if (isset($_POST['remove_images'])) {
                $selectedImages = $_POST['remove_images'];
                foreach ($selectedImages as $selectedImage) {
                    // Remove the selected image from the array of image names.
                    $key = array_search($selectedImage, $productImagesNames);
                    if ($key !== false) {
                        unset($productImagesNames[$key]);
                    }
                }
            }

            // Save the updated product details to the database.
            $this->productModel->updateProduct($productId, $productName, $productDescription, $productPublicationDate, $productImagesNames);

            // Set a session variable to indicate the success status.
            $_SESSION['editProductSuccess'] = true;

            // Redirect to a different page to prevent form resubmission.
            header('Location: /edit-product-success');
            exit;
        }
        $hideLoginOption = isset($user);
        $user = $_SESSION['user'];

        include __DIR__ . '/../templates/header.php';
        include __DIR__ . '/../partials/flash-message.php';
        // Render the view to edit the product.
        include __DIR__ . '/../templates/user/products/edit-product.php';
        include __DIR__ . '/../templates/footer.php';
    }

    public function editProductSuccess(): void
    {
        // Check if the editContactSuccess session variable is set to true.
        if (!isset($_SESSION['editProductSuccess']) || !$_SESSION['editProductSuccess']) {
            header('Location: /');
            exit;
        }

        // Unset the editContactSuccess session variable.
        unset($_SESSION['editProductSuccess']);
        $hideLoginOption = isset($user);
        $user = $_SESSION['user'];

        // Render the view with the header and footer included.
        include __DIR__ . '/../templates/header.php';
        // Render the view for the edit contact success page.
        include __DIR__ . '/../templates/user/products/edit-product-success.php';
        include __DIR__ . '/../templates/footer.php';

    }

    private function handleProductImages($productImages): array
    {
        $productImagesPaths = [];

        // Check if any images were uploaded.
        if (!empty($productImages['name'][0])) {
            $totalImages = count($productImages['name']);

            // Loop through each uploaded image.
            for ($i = 0; $i < $totalImages; $i++) {
                $tmpFilePath = $productImages['tmp_name'][$i];
                $fileName = $productImages['name'][$i];

                // Validate the image file if required.
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (!in_array($fileExtension, $allowedExtensions)) {
                    FlashMessageHelper::setFlashMessage('error', 'Invalid file type. Only JPG, JPEG, PNG, and WEBP files are allowed.');
                    header('Location: /create-product');
                    exit;
                }

                // Sanitize the file name.
                $sanitizedFileName = uniqid() . '_' . filter_var($fileName, FILTER_SANITIZE_SPECIAL_CHARS);

                // Move the uploaded image to a desired directory.
                $destination = $_SERVER['DOCUMENT_ROOT'] . '/../public/assets/images/' . $sanitizedFileName;
                move_uploaded_file($tmpFilePath, $destination);

                // Store the image path in the array.
                $productImagesPaths[] = $sanitizedFileName;
            }
        }

        return $productImagesPaths;
    }

    public function deleteProduct(): void
    {
        // Check if the user is logged in.
        if (!isset($_SESSION['user'])) {
            FlashMessageHelper::setFlashMessage('error', 'You must be logged in to delete a product.');
            header('Location: /');
            exit;
        }

        // Get the logged-in user's ID.
        $userId = $_SESSION['user']['id'];

        // Check if the confirmation form is submitted.
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
            $confirm = $_POST['confirm'];

            // Get the product ID from the request.
            $productId = $_POST['product_id'] ?? null;

            // Check if the product ID is provided.
            if (!$productId) {
                FlashMessageHelper::setFlashMessage('error', 'Product ID is missing.');
                header('Location: /');
                exit;
            }

            // Get the product details from the database.
            $product = $this->productModel->getProductById($productId);

            // Check if the product exists and belongs to the logged-in user.
            if (!$product || $product['user_id'] !== $userId) {
                header('Location: /404');
                exit;
            }

            if ($confirm === 'yes') {
                // Delete the product from the database.
                $this->productModel->deleteProduct($productId);

                // Set a session variable to indicate the success status.
                $_SESSION['deleteProductSuccess'] = true;

                // Redirect to a different page to prevent form resubmission.
                header('Location: /delete-product-success');
            } else {
                // Redirect to the product details page or any other appropriate page.
                header('Location: /product-details?id=' . $productId);
            }
            exit;
        } else {
            // Get the product ID from the request.
            $productId = $_GET['id'] ?? null;

            // Check if the product ID is provided.
            if (!$productId) {
                FlashMessageHelper::setFlashMessage('error', 'Product ID is missing.');
                header('Location: /');
                exit;
            }

            // Get the product details from the database.
            $product = $this->productModel->getProductById($productId);

            // Check if the product exists and belongs to the logged-in user.
            if (!$product || $product['user_id'] !== $userId) {
                header('Location: /404');
                exit;
            }
            $hideLoginOption = isset($user);
            $user = $_SESSION['user'];

            // Render the view with the header and footer included.
            include __DIR__ . '/../templates/header.php';
            // Render the confirmation view.
            include __DIR__ . '/../templates/user/products/delete-product-confirm.php';
            include __DIR__ . '/../templates/footer.php';
        }
    }

    public function deleteProductConfirm($productId): void
    {
        // Get the product details from the database.
        $product = $this->productModel->getProductById($productId);

        // Check if the product exists.
        if (!$product) {
            header('Location: /404');
            exit;
        }
        $hideLoginOption = isset($user);
        $user = $_SESSION['user'];

        // Render the view with the header and footer included.
        include __DIR__ . '/../templates/header.php';
        // Render the confirmation view.
        include __DIR__ . '/../templates/user/products/delete-product-confirm.php';
        include __DIR__ . '/../templates/footer.php';
    }

    public function deleteProductSuccess(): void
    {
        // Check if the editContactSuccess session variable is set to true.
        if (!isset($_SESSION['deleteProductSuccess']) || !$_SESSION['deleteProductSuccess']) {
            header('Location: /');
            exit;
        }
        $hideLoginOption = isset($user);

        // Unset the editContactSuccess session variable.
        unset($_SESSION['deleteProductSuccess']);
        $user = $_SESSION['user'];

        // Render the view with the header and footer included.
        include __DIR__ . '/../templates/header.php';
        // Render the view for the edit contact success page.
        include __DIR__ . '/../templates/user/products/delete-product-success.php';
        include __DIR__ . '/../templates/footer.php';
    }
}