<?php

namespace App\Controllers;

use App\View;

class PostController {

    public function render() {
        return View::show('post');
    }
}