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

    // TODO: Add other methods for, edit, delete unlimited items for sale after log in.
}