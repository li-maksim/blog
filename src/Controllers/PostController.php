<?php

declare(strict_types = 1);
namespace App\Controllers;

use App\View;
use App\Controller;
use App\DB;

class PostController extends Controller {

    public function render() {
        return $this->renderView('post', ['allTitles' => $allTitles]);
    }
}