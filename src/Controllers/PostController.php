<?php

declare(strict_types = 1);
namespace App\Controllers;

use App\View;
use App\Controller;
use App\Models\Posts;

class PostController extends Controller {

    private Posts $postsModel;

    private function getPostId() {
        return $_GET['id'];
    }

    public function __construct() {
        $this->postsModel = new Posts();
    }

    public function renderCreatePage() {
        if ($_SESSION['account_loggedin'] ?? false) {
            return $this->renderView('post/create', ['btnText' => 'Create']);
        } else {
            return View::show('404');
        }
    }

    public function renderPost() {
        $id = $this->getPostId();

        $post = $this->postsModel->getPostById($id);

        if (!$post) {
            return $this->renderView('404');
        }

        $editable = $post['author_id'] == $_SESSION['account_id'];

        $params = [
            'title' => $post['title'],
            'body' => nl2br(htmlspecialchars($post['body'])),
            'createdAt' => $this->formatDate($post['created_at']),
            'updatedAt' => $this->formatDate($post['updated_at']),
            'author' => $post['author_name'],
            'id' => $post['id'],
            'editable' => $editable
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
        $id = $_SESSION['account_id'];


        $this->postsModel->createNewPost($title, $body, $id);
        header('Location: /');
        exit;
    }

    public function renderEditPage() {
        $postId = $this->getPostId();
        $post = $this->postsModel->getPostById($postId);

        if ($_SESSION['account_id'] !== $post['author_id']) {
            return View::show('404');
        }

        return View::show('post/create', ['oldTitle' => $post['title'], 'oldBody' => htmlspecialchars($post['body']), 'btnText' => 'Edit']);
    }

    public function updatePost() {
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
}