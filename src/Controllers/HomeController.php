<?php
namespace Controllers;

use Models\Product;

class HomeController
{
    private Product $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function home(): void
    {
        // Check if the user is logged in.
        if (isset($_SESSION['user'])) {
            // Get the user's name.
            $user = $_SESSION['user'];
        }

        // Get all the products from the database.
        $products = $this->productModel->getAllProducts();

        // Render the view with the header and footer included.
        include __DIR__ . '/../templates/header.php';
        include __DIR__ . '/../partials/flash-message.php';
        // Render the view for the home page with the user's name.
        include __DIR__ . '/../templates/home.php';
        include __DIR__ . '/../templates/footer.php';
    }

    public function error404(): void
    {
        // Render the view with the header and footer included.
        include __DIR__ . '/../templates/header.php';
        // Render the 404 error page.
        include __DIR__ . '/../templates/error/404.php';
        include __DIR__ . '/../templates/footer.php';
    }
}