<?php

namespace App\Controllers;

use App\View;
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

    public function renderUserPosts() {
        $username = $_GET['name'];
        $posts = $this->postsModel->getPostsByUsername($username);

        $allPosts = '';

        foreach($posts as $post) {
            $params = [
                'id' => $post['id'],
                'title' => $post['title'],
                'body' => $this->shortenStr($post['body']),
                'createdAt' => $this->formatDate($post['created_at']),
                'author' => $post['author_name']
            ];
            $allPosts .= View::show('postCard', $params, true);
        }

        return $this->renderView('/user/posts', ['username' => $username, 'allPosts' => $allPosts]);
    }

    public function renderUserComments() {
        $username = $_GET['name'];
        $comments = $this->commentsModel->getCommentsByUsername($username);

        $allComments = '';

        foreach($comments as $comment) {
            $params = [
                'createdAt' => $this->formatDate($comment['created_at']),
                'body' => $comment['body'],
                'postId' => $comment['post_id']
            ];
            $allComments .= View::show('commentCard', $params, true);
        }

        return $this->renderView('/user/comments', ['username' => $username, 'allComments' => $allComments]);
    }
}