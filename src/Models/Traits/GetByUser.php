<?php

declare(strict_types = 1);
namespace App\Models\Traits;

trait GetByUser {
    protected function getAllByUserId(string | int $id): array {
        $tableName = static::TABLE_NAME;
        $sql = "SELECT * FROM $tableName WHERE author_id = ? ORDER BY $tableName.created_at DESC";
        return $this->executeSql($sql, [$id])->fetchAll();
    }

    protected function getAllByUsername(string $username, int $currentPage, int $limit): array {
        $offset = ($currentPage - 1) * $limit;

        $tableName = static::TABLE_NAME;
        $sql = "SELECT 
                    $tableName.*, 
                    users.username AS author_name 
                FROM $tableName 
                JOIN users ON $tableName.author_id = users.id 
                WHERE users.username = ?
                ORDER BY $tableName.created_at DESC
                LIMIT ? OFFSET ?";

        return $this->executeSql($sql, [$username, $limit, $offset])->fetchAll();
    }

    public function getAmountByUsername(string $username): int {
        $tableName = static::TABLE_NAME;
        $sql = "SELECT COUNT(*) 
        FROM $tableName 
        JOIN users ON $tableName.author_id = users.id 
        WHERE users.username = ?";
        
        return (int) $this->executeSql($sql, [$username])->fetchColumn();
    }
}