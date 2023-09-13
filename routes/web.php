<?php

use Controllers\UserController;
use Models\User;


// Create an instance of the Controllers\UserController and pass the PDO object if it exists.
$userController = (!empty($pdo) ? new UserController($pdo) : null);

// Define the routes and their actions.
$routes = [
    '/' => function () use ($userController) {
        $userController->home();
    },
    '/register' => function () use ($userController) {
        $userController->register();
    },
    '/login' => function () use ($userController) {
        $userController->login();
    },
];
