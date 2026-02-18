<?php

declare(strict_types = 1);
namespace App\Models;

use App\Model;

class Posts extends Model {

    protected const TABLE_NAME = 'posts';

    public function getAllPosts(): array {
        $sql = "SELECT 
                    posts.*,
                    users.username AS author_name
                FROM posts
                JOIN users on posts.author_id = users.id
                ORDER BY posts.created_at DESC";

        return $this->executeSql($sql)->fetchAll();
    }

    public function getPostById($id): array | false {

        if (!$this->checkIfXExists('id', $id)) {
            return false;
        }

        $sql = "SELECT 
                    posts.*, 
                    users.username AS author_name 
                FROM posts 
                JOIN users ON posts.author_id = users.id 
                WHERE posts.id = $id";
        return $this->executeSql($sql)->fetch();
    }

    public function createNewPost($title, $body, $authorId): void {
        $this->insertInto(['title', 'body', 'author_id'], [$title, $body, $authorId]);
    }

    public function updatePost(string $id, array $vals): void {
        $sql = "UPDATE posts
                    SET title = ?, body = ?
                WHERE id = ?";
        array_push($vals, $id);

        $this->executeSql($sql, $vals);
    }
}