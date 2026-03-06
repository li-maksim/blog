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
        return date_format($dateTime, 'd.m.Y, H:i');
    }

    protected function checkIfLoggedin() {
        if (empty($_SESSION['account_loggedin'])) {
            return false;
        } else {
            return true;
        }
    }

    protected function shortenStr(string $str): string {
        if (strlen($str) > 250) {
            return trim(substr($str, 0, 250)) . '...';
        } else {
            return $str;
        }
    }
}