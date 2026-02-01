<?php

namespace App\Controllers;

use App\View;

class HomeController {

    public function render() {
        return View::show('home');
    }
}