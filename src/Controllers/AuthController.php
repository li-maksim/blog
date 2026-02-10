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
        return $this->renderView('signup');
    }

    public function signUp() {

        if (!isset($_POST['username'], $_POST['email'], $_POST['password'])) {
            throw new \Exception('Please fill out all fields');
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
            if ($this->usersModel->login($email, $password)) {
            echo 'Welcome back, ' . htmlspecialchars($_SESSION['account_name'], ENT_QUOTES) . '!';
            } else {
                echo 'Incorrect username/password';
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function logout() {
        $this->usersModel->logout();
    }
}