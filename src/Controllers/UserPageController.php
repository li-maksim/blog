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

    // To do: refactor to not repeat this code
    public function renderMyPage() {
        if ($this->checkIfLoggedin()) {
            $name = $_SESSION['account_name'];
            $user = $this->usersModel->getUserByName($name);

            $posts = $this->postsModel->getPostsByUserId($_SESSION['account_id']);
            $allPosts = '';
            foreach($posts as $post) {
                $params = [
                    'id' => $post['id'],
                    'title' => $post['title'],
                    'body' => $this->shortenStr($post['body']),
                    'createdAt' => $this->formatDate($post['created_at']),
                    'author' => $name,
                    'editable' => true
                ];
                $allPosts .= View::show('postCard', $params, true);
            }

            $comments = $this->commentsModel->getCommentsByUserId($_SESSION['account_id']);
            $allComments = '';
            foreach($comments as $comment) {
                $params = [
                    'createdAt' => $this->formatDate($comment['created_at']),
                    'body' => $comment['body'],
                    'postId' => $comment['post_id'],
                    'commentId' => $comment['id'],
                    'isAuthor' => true
                ];
                $allComments .= View::show('commentCard', $params, true);
            }

            $params = [
                'myPage' => true,
                'username' => $name,
                'email' => $user['email'],
                'postsNum' => count($posts),
                'commentsNum' => count($comments),
                'allPosts' => $allPosts,
                'allComments' => $allComments
            ];
            return $this->renderView('user', $params);
        } else {
            return $this->renderView('404');
        }
    }

    public function renderUserPage() {
        $name = $_GET['name'];
        // Redirecting to /my_page if the user's id is matching the logged in user's id
        if (!empty($_SESSION['account_name']) && $name === $_SESSION['account_name']) {
            header("Location: /my_page");
            exit;
        }
        try {
            $user = $this->usersModel->getUserByName($name);
            $posts = $this->postsModel->getPostsByUsername($name);

            $allPosts = '';

            foreach($posts as $post) {
                $params = [
                    'id' => $post['id'],
                    'title' => $post['title'],
                    'body' => $this->shortenStr($post['body']),
                    'createdAt' => $this->formatDate($post['created_at']),
                    'author' => $name,
                    'editable' => false
                ];
                $allPosts .= View::show('postCard', $params, true);
            }

            $comments = $this->commentsModel->getCommentsByUsername($name);
            $allComments = '';
            foreach($comments as $comment) {
                $params = [
                    'createdAt' => $this->formatDate($comment['created_at']),
                    'body' => $comment['body'],
                    'postId' => $comment['post_id'],
                    'commentId' => $comment['id'],
                    'isAuthor' => false
                ];
                $allComments .= View::show('commentCard', $params, true);
            }

            $params = [
                'myPage' => false,
                'username' => $name,
                'postsNum' => count($posts),
                'commentsNum' => count($comments),
                'allPosts' => $allPosts,
                'allComments' => $allComments
            ];
            return $this->renderView('user', $params);
        } catch (ThisUserDoesntExist $e) {
            return $this->renderView('404');
        }
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
            $params = [
                'createdAt' => $this->formatDate($comment['created_at']),
                'body' => $comment['body'],
                'postId' => $comment['post_id'],
                'commentId' => $comment['id'],
                'isAuthor' => $isAuthor
            ];
            $allComments .= View::show('commentCard', $params, true);
        }

        return $this->renderView('/user/comments', ['username' => $username, 'allComments' => $allComments]);
    }
}