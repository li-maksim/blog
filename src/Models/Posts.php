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

    public function getPostById(string $id): array | false {

        if (!$this->checkIfXExists('id', $id)) {
            return false;
        }

        $sql = "SELECT 
                    posts.*, 
                    users.username AS author_name 
                FROM posts 
                JOIN users ON posts.author_id = users.id 
                WHERE posts.id = ?";
        return $this->executeSql($sql, [$id])->fetch();
    }

    public function getPostsByUserId(string | int $id): array {
        return $this->getAllByUserId($id);
    }

    public function getPostsByUsername(string $username): array {
        return $this->getAllByUsername($username);
    }

    public function createNewPost(string $title, string $body, string $authorId): void {
        $this->insertInto(['title', 'body', 'author_id'], [$title, $body, $authorId]);
    }

    public function updatePost(string $id, array $vals): void {
        $sql = "UPDATE posts
                    SET title = ?, body = ?
                WHERE id = ?";
        array_push($vals, $id);

        $this->executeSql($sql, $vals);
    }

    public function deletePost(string $id) {
        $sql = "DELETE FROM posts WHERE id = ?";
        $this->executeSql($sql, [$id]);
    }
}