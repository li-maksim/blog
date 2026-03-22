<?php

declare(strict_types = 1);
namespace App;

use PDO;
use PDOException;

class DB {

    private static ?PDO $instance = null;
    private function __construct() {}
    private function __clone() {}

    public static function getInstance(): PDO {

        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        if (self::$instance === null) {
            try {
            self::$instance = new PDO(
                CONFIG['driver'] . ':host=' . CONFIG['host'] . ';dbname=' . CONFIG['database'],
                CONFIG['user'],
                CONFIG['pass'],
                CONFIG['options'] ?? $defaultOptions
            );
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int) $e->getCode());
            }
        }

        return self::$instance;
    }
}