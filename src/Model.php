<?php

declare(strict_types = 1);
namespace App;

use App\DB;
use App\Exceptions\AuthException;

abstract class Model {

    protected const TABLE_NAME = '';

    protected \PDO $pdo;

    public function __construct() {
        $this->pdo = DB::getInstance();
    }

    protected function checkIfXExists(string $colName, $x): bool {

        $tableName = static::TABLE_NAME;

        $sql = "SELECT 1 FROM `$tableName` WHERE `$colName` = ?";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$x]);
            return (bool) $stmt->fetch();
        } catch(\PDOException $e) {
            echo 'There was a problem running this query';
        }
    }

    protected function insertInto(array $keys, array $values): void {

        $tableName = static::TABLE_NAME;

        $keysStr = implode(', ', $keys);

        $args = '';
        for ($i = 0; $i < count($keys); $i++) {
            if ($i === count($keys) - 1) {
                $args = $args . '?';
            } else {
                $args = $args . '?, ';
            }
        }

        $sql = "INSERT INTO $tableName ($keysStr) VALUES ($args)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($values);
            // echo $sql;
        } catch(\PDOException $e) {
            if ($pdo->inTransaction()) {
            $pdo->rollBack();
            }
            throw new AuthException("Database error: " . $e->getMessage());
        }
    }
}