<?php

declare(strict_types = 1);
namespace App;

use App\DB;

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
                $args .= '?';
            } else {
                $args .= '?, ';
            }
        }

        $sql = "INSERT INTO $tableName ($keysStr) VALUES ($args)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($values);
        } catch(\PDOException $e) {
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }

    protected function executeSql(string $sql, array $vals = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            if (!count($vals)) {
                $stmt->execute();
            } else {
                $stmt->execute($vals);
            }
            return $stmt;
        } catch(\PDOException $e) {
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }
    
    protected function getAllByUserId(string | int $id): array {
        $tableName = static::TABLE_NAME;
        $sql = "SELECT * FROM $tableName WHERE author_id = ? ORDER BY $tableName.created_at DESC";
        return $this->executeSql($sql, [$id])->fetchAll();
    }

    protected function getAllByUsername(string $username): array {
        $tableName = static::TABLE_NAME;
        $sql = "SELECT 
                    $tableName.*, 
                    users.username AS author_name 
                FROM $tableName 
                JOIN users ON $tableName.author_id = users.id 
                WHERE users.username = ?
                ORDER BY $tableName.created_at DESC";
        return $this->executeSql($sql, [$username])->fetchAll();
    }
}