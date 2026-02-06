<?php

namespace App\Controllers;

use App\View;
use App\Controller;

class AuthController extends Controller {

    public function renderLogin() {
        return $this->renderView('login');
    }

    public function renderSignUp() {
        return $this->renderView('signup');
    }
}