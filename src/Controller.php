<?php

namespace App;

use App\View;

abstract class Controller {

    protected function renderView(string $path, array $params = []) {
        return View::show($path, $params);
    }

    protected function formatDate($date) {
        if ($date == null) {
            return false;
        }
        $dateTime = new \DateTime($date);
        return date_format($dateTime, 'd-m-Y, H:i');
    }
}