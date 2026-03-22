<?php

declare(strict_types = 1);
namespace App\Models;

use App\Model;
use App\Models\Traits\GetByUser;

class Comments extends Model {
    use GetByUser;
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

    public function getCommentsByUsername(string $username, int $currentPage = 1, int $limit = PAGE_LIMIT): array {
        return $this->getAllByUsername($username, $currentPage, $limit);
    }

    public function getAmountOfCommentsByUsername(string $username): int {
        return $this->getAmountByUsername($username);
    }

    public function getCommentById(string | int $id): array {
        $sql = "SELECT * FROM comments WHERE id = ?";
        return $this->executeSql($sql, [$id])->fetch();
    }

    public function postNewComment(string $postId, string $authorId, string $body): void {
        $this->insertInto(['post_id', 'author_id', 'body'], [$postId, $authorId, $body]);
    }

    public function deleteCommentById(string | int $id): void {
        $sql = "DELETE FROM comments WHERE id = ?";
        $this->executeSql($sql, [$id]);
    }
}