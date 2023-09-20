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

        // Render the view for the home page with the user's name.
        include __DIR__ . '/../templates/home.php';
    }

    public function error404(): void
    {
        // Render the 404 error page.
        include __DIR__ . '/../templates/error/404.php';
    }
}