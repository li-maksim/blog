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
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password =  htmlspecialchars($_POST['password']);

        try {
            $this->usersModel->signUp($username, $email, $password);
            echo 'Success!';
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}