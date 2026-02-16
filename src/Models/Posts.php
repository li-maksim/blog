<?php

declare(strict_types = 1);
namespace App\Models;

use App\Model;

class Posts extends Model {

    protected const TABLE_NAME = 'posts';

    public function getAllPosts(): array {

        $tableName = static::TABLE_NAME;

        $sql = "SELECT 
                    posts.*,
                    users.username AS author_name
                FROM posts
                JOIN users on posts.author_id = users.id
                ORDER BY posts.created_at DESC";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();

        } catch(\PDOException $e) {
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }
}