<?php

declare(strict_types = 1);
namespace App\Controllers;

use App\View;
use App\Controller;
use App\Models\Posts;
use App\Models\Comments;
use App\Controllers\Traits\FormatDate;

class PostController extends Controller {
    use FormatDate;
    private Posts $postsModel;
    private Comments $commentsModel;

    public function __construct() {
        $this->postsModel = new Posts();
        $this->commentsModel = new Comments();
    }

    private function getPostId(): string {
        return $_GET['id'];
    }

    private function verifyAuthor(): bool {
        $post = $this->postsModel->getPostById($this->getPostId());
        if (($_SESSION['account_id'] ?? '') !== $post['author_id']) {
            return false;
        } else {
            return true;
        }
    }

    public function renderCreatePage(): string {
        if ($_SESSION['account_loggedin'] ?? false) {
            return $this->renderView('post/create', ['edit' => false]);
        } else {
            return $this->renderView('404');
        }
    }

    public function renderPost(): string {
        $id = $this->getPostId();

        $post = $this->postsModel->getPostById($id);

        if (!$post) {
            return $this->renderView('404');
        }

        $comments = $this->commentsModel->getCommentsByPostId($id) ?? '';
        $allComments = '';
        if ($comments) {
            foreach($comments as $comment) {
                $isAuthor = false;
                if (($_SESSION['account_id'] ?? '') !== $comment['author_id']) {
                    $isAuthor = false;
                } else {
                    $isAuthor = true;
                }
                $params = [
                    'body' => nl2br(htmlspecialchars($comment['body'])),
                    'createdAt' => $this->formatDate($comment['created_at']),
                    'author' => $comment['author_name'],
                    'isAuthor' => ($isAuthor || $this->checkIfAdmin()),
                    'commentId' => $comment['id']
                ];
                $allComments .= View::show('comment', $params, true);
            }
        }

        $params = [
            'title' => $post['title'],
            'body' => nl2br(htmlspecialchars($post['body'])),
            'createdAt' => $this->formatDate($post['created_at']),
            'updatedAt' => $this->formatDate($post['updated_at']),
            'author' => $post['author_name'],
            'id' => $post['id'],
            'editable' => $this->verifyAuthor(),
            'deletable' => ($this->verifyAuthor() || $this->checkIfAdmin()),
            'allComments' => $allComments
        ]; 

        return $this->renderView('post', $params);
    }

    public function createNewPost(): void {
        if (empty($_POST['title']) || empty($_POST['body'])) {
            $_SESSION['flash_error'] = "Please fill out all the required fields";
            $_SESSION['old_title'] = $_POST['title'] ?? '';
            $_SESSION['old_body'] = $_POST['body'] ?? '';
            header('Location: /post/create');
            exit;
        }

        $title = $_POST['title'];
        $body = $_POST['body'];
        $id = (string) $_SESSION['account_id'];


        $this->postsModel->createNewPost($title, $body, $id);
        header('Location: /');
        exit;
    }

    public function renderEditPage(): string {
        $post = $this->postsModel->getPostById($this->getPostId());

        if (!$this->verifyAuthor()) {
            return $this->renderView('404');
        }

        return $this->renderView('post/create', [
            'oldTitle' => $post['title'], 
            'oldBody' => htmlspecialchars($post['body']), 
            'edit' => true
        ]);
    }

    public function updatePost(): never {
        $id = $this->getPostId();

        if (empty($_POST['title']) || empty($_POST['body'])) {
            $_SESSION['flash_error'] = "Please fill out all the required fields";
            $_SESSION['old_title'] = $_POST['title'] ?? '';
            $_SESSION['old_body'] = $_POST['body'] ?? '';
            header('Location: /post/create');
            exit;
        }

        $title = $_POST['title'];
        $body = $_POST['body'];

        $this->postsModel->updatePost($id, [$title, $body]);
        header("Location: /post?id=$id");
        exit;
    }

    public function deletePost(): string {
        if (!$this->verifyAuthor() && !$this->checkIfAdmin()) {
            return View::show('404');
        }

        $this->postsModel->deletePost($this->getPostId());
        header("Location: /");
        exit;
    }

    public function postNewComment(): never {
        $this
            ->commentsModel
            ->postNewComment($this->getPostId(), (string) $_SESSION['account_id'], $_POST['body']);

        $id = $this->getPostId();
        header("Location: /post?id=$id");
        exit;
    }
}