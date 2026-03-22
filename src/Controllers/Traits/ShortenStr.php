<?php

declare(strict_types = 1);
namespace App\Controllers\Traits;

trait ShortenStr {
    protected function shortenStr(string $str): string {
        if (strlen($str) > 250) {
            return trim(substr($str, 0, 250)) . '...';
        } else {
            return $str;
        }
    }
}