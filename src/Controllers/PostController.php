<?php

declare(strict_types = 1);
namespace App\Controllers;

use App\View;
use App\Controller;
use App\Models\Posts;

class PostController extends Controller {

    private Posts $postsModel;

    public function __construct() {
        $this->postsModel = new Posts();
    }

    public function renderCreatePage() {
        if ($_SESSION['account_loggedin'] ?? false) {
            return $this->renderView('post/create');
        } else {
            echo View::show('404');
        }
    }

    public function renderPost() {
        
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
}