<?php

namespace App\Controllers;

use App\View;
use App\Controller;
use App\Models\Users;
use App\Models\Posts;
use App\Models\Comments;
use App\Exceptions\ThisUserDoesntExist;

class UserPageController extends Controller {
    private Users $usersModel;
    private Posts $postsModel;
    private Comments $commentsModel;

    public function __construct() {
        $this->usersModel = new Users();
        $this->postsModel = new Posts();
        $this->commentsModel = new Comments();
    }

    private function renderUserPage(bool $isMyPage, string $name) {
        try {
            $user = $this->usersModel->getUserByName($name);
        } catch (ThisUserDoesntExist $e) {
            return $this->renderView('404');
        }

        $posts = $this->postsModel->getPostsByUsername($name);
        $allPosts = '';
        foreach($posts as $post) {
            $params = [
                'id' => $post['id'],
                'title' => $post['title'],
                'body' => $this->shortenStr($post['body']),
                'createdAt' => $this->formatDate($post['created_at']),
                'author' => $name,
                'editable' => $isMyPage
            ];
            $allPosts .= View::show('postCard', $params, true);
        }

        $comments = $this->commentsModel->getCommentsByUserId($user['id']);
        $allComments = '';
        foreach($comments as $comment) {
            $postTitle = $this->postsModel->getPostById($comment['post_id'])['title'];
            $params = [
                'createdAt' => $this->formatDate($comment['created_at']),
                'body' => $comment['body'],
                'postTitle' => $postTitle,
                'postId' => $comment['post_id'],
                'commentId' => $comment['id'],
                'isAuthor' => $isMyPage
            ];
            $allComments .= View::show('commentCard', $params, true);
        }

        $userEmail = '';
        if ($isMyPage) {
            $userEmail = $user['email'];
        }

        $params = [
            'myPage' => $isMyPage,
            'username' => $name,
            'email' => $userEmail,
            'postsNum' => count($posts),
            'commentsNum' => count($comments),
            'allPosts' => $allPosts,
            'allComments' => $allComments
        ];
        return $this->renderView('user', $params);
    }

    public function renderMyPage() {
        if (!$this->checkIfLoggedin()) {
            return $this->renderView('404');
        }
        $name = $_SESSION['account_name'];
        return $this->renderUserPage(true, $name);
    }

    public function renderOtherUsersPage() {
        $name = $_GET['name'];
        // Redirecting to /my_page if the user's id is matching the logged in user's id
        if (!empty($_SESSION['account_name']) && $name === $_SESSION['account_name']) {
            header("Location: /my_page");
            exit;
        }
        return $this->renderUserPage(false, $name);
    }

    public function renderUserPosts() {
        $username = $_GET['name'];
        $posts = $this->postsModel->getPostsByUsername($username);

        $allPosts = '';
        $editable = false;

        if (!empty($posts[0]['author_id']) && !empty($_SESSION['account_id']) && $posts[0]['author_id'] === $_SESSION['account_id']) {
            $editable = true;
        }

        foreach($posts as $post) {
            $params = [
                'id' => $post['id'],
                'title' => $post['title'],
                'body' => $this->shortenStr($post['body']),
                'createdAt' => $this->formatDate($post['created_at']),
                'author' => $post['author_name'],
                'editable' => $editable
            ];
            $allPosts .= View::show('postCard', $params, true);
        }

        return $this->renderView('/user/posts', ['username' => $username, 'allPosts' => $allPosts]);
    }

    public function renderUserComments() {
        $username = $_GET['name'];
        $comments = $this->commentsModel->getCommentsByUsername($username);

        $allComments = '';
        $isAuthor = false;

        if (!empty($comments[0]['author_id']) && !empty($_SESSION['account_id']) && $comments[0]['author_id'] === $_SESSION['account_id']) {
            $isAuthor = true;
        }

        foreach($comments as $comment) {
            $postTitle = $this->postsModel->getPostById($comment['post_id'])['title'];
            $params = [
                'createdAt' => $this->formatDate($comment['created_at']),
                'body' => $comment['body'],
                'postTitle' => $postTitle,
                'postId' => $comment['post_id'],
                'commentId' => $comment['id'],
                'isAuthor' => $isAuthor
            ];
            $allComments .= View::show('commentCard', $params, true);
        }

        return $this->renderView('/user/comments', ['username' => $username, 'allComments' => $allComments]);
    }
}