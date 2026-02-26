<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Users;
use App\Models\Posts;
use App\Models\Comments;

class UserPageController extends Controller {
    private Users $usersModel;
    private Posts $postsModel;
    private Comments $commentsModel;

    public function __construct() {
        $this->usersModel = new Users();
        $this->postsModel = new Posts();
        $this->commentsModel = new Comments();
    }

    public function renderMyPage() {
        if ($this->checkIfLoggedin()) {
            $posts = $this->postsModel->getPostsByUserId($_SESSION['account_id']);
            $comments = $this->commentsModel->getCommentsByUserId($_SESSION['account_id']);
            $params = [
                'myPage' => true,
                'username' => $_SESSION['account_name'],
                'postsNum' => count($posts),
                'commentsNum' => count($comments)
            ];
            return $this->renderView('user', $params);
        } else {
            return $this->renderView('404');
        }
    }

    public function renderUserPage() {
        if (!empty($_SESSION['account_name']) && $_GET['name'] === $_SESSION['account_name']) {
            header("Location: /my_page");
            exit;
        }
        $posts = $this->postsModel->getPostsByUsername($_GET['name']);
        $comments = $this->commentsModel->getCommentsByUsername($_GET['name']);
        $params = [
            'myPage' => false,
            'username' => $_GET['name'],
            'postsNum' => count($posts),
            'commentsNum' => count($comments)
        ];
        return $this->renderView('user', $params);
    }
}