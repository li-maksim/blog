<?php

namespace App;

use App\View;

abstract class Controller {

    protected function renderView(string $path, array $params = []) {
        return View::show($path, $params);
    }
}