<?php

declare(strict_types = 1);
namespace App\Models;

use App\Model;
use App\Models\Traits\GetByUser;

class Posts extends Model {
    use GetByUser;
    protected const TABLE_NAME = 'posts';

    public function getAllPosts(int $page = 1, int $limit = PAGE_LIMIT): array {
        $offset = ($page - 1) * $limit;

        $sql = "SELECT 
                    posts.*,
                    users.username AS author_name
                FROM posts
                JOIN users on posts.author_id = users.id
                ORDER BY posts.created_at DESC
                LIMIT ? OFFSET ?";

        return $this->executeSql($sql, [$limit, $offset])->fetchAll();
    }

    public function getAmountOfPosts(): int {
        $sql = "SELECT COUNT(*) FROM posts";
        return (int) $this->executeSql($sql)->fetchColumn();
    }

    public function getPostById(string | int $id): array | false {

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

    public function getPostsByUsername(string $username, int $currentPage = 1, int $limit = PAGE_LIMIT): array {
        return $this->getAllByUsername($username, $currentPage, $limit);
    }

    public function getAmountOfPostsByUsername(string $username): int {
        return $this->getAmountByUsername($username);
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

    public function deletePost(string $id): void {
        $sql = "DELETE FROM posts WHERE id = ?";
        $this->executeSql($sql, [$id]);
    }
}