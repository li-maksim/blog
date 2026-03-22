<?php

declare(strict_types = 1);
namespace App;

use App\View;

abstract class Controller {

    protected function renderView(string $path, array $params = []): string {
        return View::show($path, $params);
    }

    protected function checkIfAdmin(): bool {
        return !empty($_SESSION['account_name']) ? $_SESSION['account_name'] === 'admin' : false;
    }
}