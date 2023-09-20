<?php

// Set the session cookie lifetime to 1 hour (3600 seconds)
session_set_cookie_params(3600);

// Start a new session.
session_start();

use Controllers\UserController;
use Controllers\ProductController;
use Controllers\HomeController;
use Models\User;

// Create an instance of the User model.
$userModel = (!empty($pdo) ? new User($pdo) : null);

// Create an instance of the Controllers\UserController and pass the PDO object if it exists.
$userController = (!empty($pdo) ? new UserController(new User($pdo)) : null);
$productController = (!empty($userModel) ? new ProductController($userModel) : null);
$homeController = (!empty($userModel) ? new HomeController() : null);
// Get the product ID from the request query parameters.
$productId = $_GET['id'] ?? null;

// Define the routes and their actions.
$routes = [
    '/' => function () use ($homeController) {
        $homeController->home();
    },
    '/register' => function () use ($userController) {
        $userController->register();
    },
    '/login' => function () use ($userController) {
        $userController->login();
    },
    '/edit-contact' => function () use ($userController) {
        $userController->editContactInformation();
    },
    '/edit-contact-success' => function () use ($userController) {
        $userController->editContactSuccess();
    },
    '/create-product' => function () use ($productController) {
        $productController->createProduct();
    },
    '/product-created' => function () use ($productController) {
        include '../src/templates/user/products/creation-success.php';
    },
    '/edit-product?id=' . $productId => function () use ($productController) {
        // Check if the product ID is provided.
        if (!$_GET['id']) {
            echo 'Product ID is missing.';
            return;
        }

        // Call the editProduct() method with the product ID.
        $productController->editProduct();
    },
    '/edit-product-success' => function () use ($productController) {
        $productController->editProductSuccess();
    },
    '/logout' => function () use ($userController) {
        $userController->logout();
    },
    // 404 page route
    '/404' => function () use ($homeController) {
        $homeController->error404();
    },
];
