<?php

use Controllers\UserController;

require_once '../config/database.php';
require_once '../src/Controllers/UserController.php';
require_once '../routes/web.php';

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
        // Handle other routes or show a 404 page.
        echo '404 - Page not found';
    }
} catch (Exception $e) {
    // Handle any exceptions
    echo 'Error: ' . $e->getMessage();
}