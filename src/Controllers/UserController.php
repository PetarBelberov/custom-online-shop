<?php

namespace Controllers;
use JetBrains\PhpStorm\NoReturn;
use Models\User;

// Temp
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class UserController
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function home(): void
    {
        // Check if the user is logged in.
        if (isset($_SESSION['user'])) {
            // Get the user's name.
            $user = $_SESSION['user'];

            // Render the view for the home page with the user's name.
            include __DIR__ . '/../templates/home.php';
        } else {
            // Render the view for the home page without the user's name.
            include __DIR__ . '/../templates/home.php';
        }
    }

    public function register(): void
    {
        // Check if the user is already logged in.
        if (isset($_SESSION['user'])) {
            // Redirect to the home page.
            header('Location: /');
            exit;
        }

        // Handle the form submission to register a new user.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            // Validate the required fields.
            if (empty($name) || empty($surname) || empty($email) || empty($password) || empty($confirmPassword)) {
                echo 'Name, surname, email, password, and confirm password are mandatory fields.';
                return;
            }

            // Validate password and confirm password match.
            if ($password !== $confirmPassword) {
                echo 'Password and confirm password do not match.';
                return;
            }

            // Hash the password.
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user into the database.
            $this->userModel->setUser($name, $surname, $email, $phone, $city, $hashedPassword);


            // Redirect to the login page.
            header('Location: /login');
            exit;
        }

        // Render the view to register a new user.
        include __DIR__ . '/../templates/user/register.php';
    }

    public function login(): void
    {
        // Check if the user is already logged in.
        if (isset($_SESSION['user'])) {
            // Redirect to the home page.
            header('Location: /');
            exit;
        }

        // Handle the form submission to log in the user.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validate the user's credentials.
            $user = $this->userModel->getUserByEmail($email);
            if ($user && password_verify($password, $user['password'])) {

                // User is authenticated, store the user's information in the session.
                $_SESSION['user'] = $user;

                header('Location: /');
                exit;
            } else {
                echo 'Invalid email or password.';
                return;
            }
        }

        // Render the view to log in the user.
        include __DIR__ . '/../templates/user/login.php';
    }

    public function editContactInformation(): void
    {
        // Check if the user is logged in.
        if (!isset($_SESSION['user'])) {
            echo 'You must be logged in to edit your contact information.';
            return;
        }

        // Get the logged-in user's ID.
        $userId = $_SESSION['user']['id'];

        // Handle the form submission to edit contact information.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the form data
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];

            // Update the contact information in the database.
            $this->userModel->updateContactInformation($userId, $name, $surname, $email, $phone, $city);

            // Set session variable to indicate success.
            $_SESSION['editContactSuccess'] = true;

            // Redirect to a success page or display a success message.
            header('Location: /edit-contact-success');
            exit;
        }

        // Get the current contact information of the user.
        $user = $this->userModel->getUserById($userId);

        // Render the view to edit contact information.
        include __DIR__ . '/../templates/user/edit-contact.php';
    }

    public function editContactSuccess(): void
    {
        // Check if the editContactSuccess session variable is set to true.
        if (!isset($_SESSION['editContactSuccess']) || !$_SESSION['editContactSuccess']) {
            header('Location: /');
            exit;
        }

        // Unset the editContactSuccess session variable.
        unset($_SESSION['editContactSuccess']);

        // Render the view for the edit contact success page.
        include __DIR__ . '/../templates/user/edit-contact-success.php';
    }

    #[NoReturn] public function logout(): void
    {
        // Clear the user's session data.
        $_SESSION = array();
        session_destroy();

        // Redirect to the login page.
        header('Location: /login');
        exit;
    }

    public function createProduct(): void
    {
        // Check if the user is logged in.
        if (!isset($_SESSION['user'])) {
            echo 'You must be logged in to create a product.';
            return;
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

            // Validate the required fields.
            if (empty($productName) || empty($productDescription) || empty($productPublicationDate) || empty($productImages)) {
                echo 'Product name, description, publication date, and image are mandatory fields.';
                return;
            }

            // Save the product to the database.
            $productImagesNames = $this->handleProductImages($productImages);
            $this->userModel->saveProduct($userId, $productName, $productDescription, $productPublicationDate, $productImagesNames);

            // Set a session variable to indicate the success status.
            $_SESSION['productCreated'] = true;

            // Redirect to a different page to prevent form resubmission.
            header('Location: /product-created');
            exit;
        }

        // Render the view to create a product.
        include __DIR__ . '/../templates/user/products/create-product.php';
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
                    echo 'Invalid file type. Only JPG, JPEG, PNG, and WEBP files are allowed.';
                    return [];
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

    public function error404(): void
    {
        // Render the 404 error page.
        include __DIR__ . '/../templates/error/404.php';
    }

    // TODO: Add other methods for, edit, delete unlimited items for sale after log in.
}