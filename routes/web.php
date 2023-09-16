<?php

// Set the session cookie lifetime to 1 hour (3600 seconds)
session_set_cookie_params(3600);

// Start a new session.
session_start();

use Controllers\UserController;
use Models\User;

// Create an instance of the Controllers\UserController and pass the PDO object if it exists.
$userController = (!empty($pdo) ? new UserController(new User($pdo)) : null);

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
    '/edit-contact' => function () use ($userController) {
        $userController->editContactInformation();
    },
    '/edit-contact-success' => function () use ($userController) {
        $userController->editContactSuccess();
    },
    '/logout' => function () use ($userController) {
        $userController->logout();
    },
];
