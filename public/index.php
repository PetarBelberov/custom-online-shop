<?php

use Controllers\UserController;

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Controllers/UserController.php';
require_once __DIR__ . '/../routes/web.php';

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