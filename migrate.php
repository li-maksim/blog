<?php

require_once 'vendor/autoload.php'; 

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('CONFIG', [
    'host'     => $_ENV['DB_HOST'],
    'user'     => $_ENV['DB_USER'],
    'pass'     => $_ENV['DB_PASS'],
    'database' => $_ENV['DB_DATABASE'],
    'driver'   => $_ENV['DB_DRIVER'],
]);


try {
    echo "Starting migrations...";
    $pdo = \App\DB::getInstance();
    $pdo->beginTransaction();
    require_once 'migrations/01_create_tables.php';
    require_once 'migrations/02_data.php';
    if ($pdo->inTransaction()) {
    $pdo->commit();
    }
    echo "Migrations were completed.";
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Error: " . $e->getMessage();
}