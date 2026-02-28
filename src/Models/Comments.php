<?php

declare(strict_types = 1);
namespace App\Models;

use App\Model;

class Comments extends Model {

    protected const TABLE_NAME = 'comments';

    public function getCommentsByPostId(string $id): array {
        $sql = "SELECT 
                    comments.*, 
                    users.username AS author_name 
                FROM comments 
                JOIN users ON comments.author_id = users.id 
                WHERE comments.post_id = ?
                ORDER BY comments.created_at DESC";

        return $this->executeSql($sql, [$id])->fetchAll();
    }

    public function getCommentsByUserId(string | int $id): array {
        return $this->getAllByUserId($id);
    }

        public function getCommentsByUsername(string $username): array {
        return $this->getAllByUsername($username);
    }

    public function getCommentById($id): array {
        $sql = "SELECT * FROM comments WHERE id = ?";
        return $this->executeSql($sql, [$id])->fetch();
    }

    public function postNewComment(string $postId, string $authorId, string $body): void {
        $this->insertInto(['post_id', 'author_id', 'body'], [$postId, $authorId, $body]);
    }

    public function deleteCommentById($id): void {
        $sql = "DELETE FROM comments WHERE id = ?";
        $this->executeSql($sql, [$id]);
    }
}