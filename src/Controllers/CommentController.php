<?php

declare(strict_types = 1);
namespace App\Controllers;

use App\Controller;
use App\Models\Comments;

class CommentController extends Controller {
    private Comments $commentsModel;

    public function __construct() {
        $this->commentsModel = new Comments();
    }

    public function deleteComment(): string {
        $commentId = $_GET['id'];
        $comment = $this->commentsModel->getCommentById($commentId);
        if ((!empty($_SESSION['account_id']) && $_SESSION['account_id'] === $comment['author_id'])
            || $this->checkIfAdmin()) {
            $this->commentsModel->deleteCommentById($commentId);
            header("Location: /");
            exit;
        } else {
            return $this->renderView('404');
        }
    }
}