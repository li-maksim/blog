<?php

declare(strict_types = 1);
namespace App\Controllers;

use App\View;
use App\Controller;
use App\Models\Users;

class AuthController extends Controller {

    private Users $usersModel;

    public function __construct() {
        $this->usersModel = new Users();
    }

    public function renderLogin() {
        return $this->renderView('login');
    }

    public function renderSignUp() {
        return $this->renderView('signup', ['error' => false]);
    }

    public function signUp() {

        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
            throw new \Exception('Please fill out all fields');
        }

        if($_POST['password'] !== $_POST['conf_password']) {
            // echo "The passwords do not match";

            $error = 'The passwords do not match';
            return;
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        try {
            $this->usersModel->signUp($username, $email, $password);
            echo 'Success!';
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function login() {
        if (!isset($_POST['email'], $_POST['password'])) {
            throw new \Exception('Please fill out all fields');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        try {

            $userData = $this->usersModel->login($email, $password);

            if ($userData) {
                $_SESSION['account_loggedin'] = true;
                $_SESSION['account_name'] = $userData['username'];
                $_SESSION['account_id'] = $userData['id'];

                header("Location: /");
                exit;
            } else {
                echo 'Incorrect username/password';
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
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