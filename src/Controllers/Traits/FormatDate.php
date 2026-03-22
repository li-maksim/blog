<?php

declare(strict_types = 1);
namespace App\Controllers\Traits;

trait FormatDate {
    protected function formatDate($date): string | false {
        if ($date == null) {
            return false;
        }
        $dateTime = new \DateTime($date);
        return date_format($dateTime, 'd.m.Y, H:i');
    }
}