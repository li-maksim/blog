<?php

namespace App\Controllers;

use App\View;
use App\Controller;

class HomeController extends Controller {

    public function render() {
        return $this->renderView('home');
    }
}