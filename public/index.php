<?php

//require_once __DIR__ . '/../autoload.php';
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/src/Controllers/UserController.php';
require_once __DIR__ . '/routes/web.php';

try {
    // Handle the request based on the URL.
    $requestUri = rtrim($_SERVER['REQUEST_URI'], '/');
    // Home page.
    if ($requestUri === '') {
        $requestUri = '/';
    }
    if (isset($routes[$requestUri])) {
        $routes[$requestUri]();
    } else {
        // Redirect to the custom 404 page.
        header('Location: /404');
        exit;
    }
} catch (Exception $e) {
    // Handle any exceptions.
    echo 'Error: ' . $e->getMessage();
}
