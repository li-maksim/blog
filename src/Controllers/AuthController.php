<?php

declare(strict_types = 1);
namespace App\Controllers;

use App\Controller;
use App\Models\Users;
use App\Exceptions\ThisUserExists;
use App\Exceptions\AuthException;

class AuthController extends Controller {

    private Users $usersModel;

    public function __construct() {
        $this->usersModel = new Users();
    }

    public function renderLogin() {
        // The data from previous login attempts
        $error = $_SESSION['flash_error'] ?? null;
        $email = $_SESSION['old_email'] ?? null;
        unset($_SESSION['flash_error'], $_SESSION['old_email']);

        return $this->renderView('login', ['error' => $error, 'email' => $email]);
    }

    public function renderSignUp() {
        // The data from previous sign up attempts
        $error = $_SESSION['flash_error'] ?? null;
        $username = $_SESSION['old_username'] ?? null;
        $email = $_SESSION['old_email'] ?? null;
        unset($_SESSION['flash_error'], $_SESSION['old_username'], $_SESSION['old_email']);

        return $this->renderView('signup', ['error' => $error, 'username' => $username, 'email' => $email]);
    }

    public function signUp() {

        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
            $_SESSION['flash_error'] = "Please fill out all the required fields";
            $_SESSION['old_username'] = $_POST['username'] ?? '';
            $_SESSION['old_email'] = $_POST['email'] ?? '';
            header('Location: /signup');
            exit;
        }

        if($_POST['password'] !== $_POST['conf_password']) {
            $_SESSION['flash_error'] = "The passwords don't match";
            $_SESSION['old_username'] = $_POST['username'] ?? '';
            $_SESSION['old_email'] = $_POST['email'] ?? '';
            header('Location: /signup');
            exit;
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        try {
            $this->usersModel->signUp($username, $email, $password);
            header('Location: /login');
            exit;
        } catch (ThisUserExists $e) {
            $_SESSION['flash_error'] = $e->getMessage();
            header('Location: /signup');
            exit;
        }
    }

    public function login() {
        // Confirming that there are no empty fields
        if ($_POST['email'] == '' || $_POST['password'] == '') {
            $_SESSION['flash_error'] = "Please fill out all the required fields";
            $_SESSION['old_email'] = $_POST['email'] ?? '';
            header('Location: /login');
            exit;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        try {

            // this method checks if the email and the password are correct
            $userData = $this->usersModel->login($email, $password);

            if ($userData) {
                $_SESSION['account_loggedin'] = true;
                $_SESSION['account_name'] = $userData['username'];
                $_SESSION['account_id'] = $userData['id'];

                header("Location: /");
                exit;
            } else {
                $_SESSION['flash_error'] = "Incorrect username/password";
                $_SESSION['old_email'] = $_POST['email'] ?? '';
                header('Location: /login');
                exit;
            }
        } catch (AuthException $e) { 
            $_SESSION['flash_error'] = $e->getMessage();
            header('Location: /login');
            exit;
        }
    }

    public function logout(): void {
        $_SESSION= [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        header("Location: /");
        exit;
    }
}