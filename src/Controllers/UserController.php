<?php

namespace Controllers;
use Helpers\FlashMessageHelper;
use JetBrains\PhpStorm\NoReturn;
use Models\User;

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
            header('Location: /404');
            exit;
        }

        // Handle the form submission to register a new user.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
            $surname = htmlspecialchars($_POST['surname'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
            $city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
            $confirmPassword = htmlspecialchars($_POST['confirm_password'], ENT_QUOTES, 'UTF-8');

            // Validate the required fields.
            if (empty($name) || empty($surname) || empty($email) || empty($password) || empty($confirmPassword)) {
                FlashMessageHelper::setFlashMessage('error', 'Name, surname, email, password, and confirm password are mandatory fields.');
                header('Location: /register');
                exit;
            }

            // Validate password and confirm password match.
            if ($password !== $confirmPassword) {
                FlashMessageHelper::setFlashMessage('error', 'Password and confirm password do not match.');
                header('Location: /register');
                exit;
            }

            // Hash the password.
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user into the database.
            $this->userModel->setUser($name, $surname, $email, $phone, $city, $hashedPassword);

            FlashMessageHelper::setFlashMessage('success', 'Registration successful! You can now log in.');            // Redirect to the login page.
            header('Location: /login');
            exit;
        }
        $hideLoginOption = isset($user);

        // Render the view with the header and footer included.
        include __DIR__ . '/../templates/header.php';
        include __DIR__ . '/../partials/flash-message.php';
        // Render the view to register a new user.
        include __DIR__ . '/../templates/user/register.php';
        include __DIR__ . '/../templates/footer.php';
    }

    public function login(): void
    {
        // Check if the user is already logged in.
        if (isset($_SESSION['user'])) {
            // Redirect to the home page.
            header('Location: /404');
            exit;
        }

        // Handle the form submission to log in the user.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

            // Validate the user's credentials.
            $user = $this->userModel->getUserByEmail($email);
            if ($user && password_verify($password, $user['password'])) {

                // User is authenticated, store the user's information in the session.
                $_SESSION['user'] = $user;

                header('Location: /');
            } else {
                FlashMessageHelper::setFlashMessage('error', 'Invalid email or password.');
                header('Location: /login');
            }
            exit;
        }
        $hideLoginOption = isset($user);

        // Render the view with the header and footer included.
        include __DIR__ . '/../templates/header.php';
        include __DIR__ . '/../partials/flash-message.php';
        // Render the view to log in the user.
        include __DIR__ . '/../templates/user/login.php';
        include __DIR__ . '/../templates/footer.php';
    }

    public function editContactInformation(): void
    {
        // Check if the user is logged in.
        if (!isset($_SESSION['user'])) {
            header('Location: /4o4');
            exit;
        }

        // Get the logged-in user's ID.
        $userId = $_SESSION['user']['id'];

        // Handle the form submission to edit contact information.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the form data
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
            $surname = htmlspecialchars($_POST['surname'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
            $city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');

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
        $hideLoginOption = isset($user);

        // Render the view with the header and footer included.
        include __DIR__ . '/../templates/header.php';
        // Render the view to edit contact information.
        include __DIR__ . '/../templates/user/edit-contact.php';
        include __DIR__ . '/../templates/footer.php';
    }

    public function editContactSuccess(): void
    {
        // Check if the editContactSuccess session variable is set to true.
        if (!isset($_SESSION['editContactSuccess']) || !$_SESSION['editContactSuccess']) {
            header('Location: /404');
            exit;
        }

        // Unset the editContactSuccess session variable.
        unset($_SESSION['editContactSuccess']);
        $hideLoginOption = isset($user);

        // Render the view with the header and footer included.
        include __DIR__ . '/../templates/header.php';
        // Render the view for the edit contact success page.
        include __DIR__ . '/../templates/user/edit-contact-success.php';
        include __DIR__ . '/../templates/footer.php';
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
}