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

    // Shared logic between rendering /my_page and other users' pages
    private function renderUserPage(bool $isMyPage, string $name): string {
        try {
            $user = $this->usersModel->getUserByName($name);
        } catch (ThisUserDoesntExist $e) {
            return $this->renderView('404');
        }

        // Showing only the most recent posts
        $recentPosts = $this->postsModel->getPostsByUsername($name);
        $totalPosts = $this->postsModel->getAmountOfPostsByUsername($name);
        $allPosts = '';
        foreach($recentPosts as $post) {
            $params = [
                'id' => $post['id'],
                'title' => $post['title'],
                'body' => $this->shortenStr($post['body']),
                'createdAt' => $this->formatDate($post['created_at']),
                'author' => $name,
                'editable' => $isMyPage,
                'deletable' => ($isMyPage || $this->checkIfAdmin())
            ];
            $allPosts .= View::show('postCard', $params, true);
        }

        // Showing only the most recent comments
        $recentComments = $this->commentsModel->getCommentsByUsername($name);
        $totalComments = $this->commentsModel->getAmountOfCommentsByUsername($name);
        $allComments = '';
        foreach($recentComments as $comment) {
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
            'postsNum' => $totalPosts,
            'commentsNum' => $totalComments,
            'allPosts' => $allPosts,
            'allComments' => $allComments
        ];
        return $this->renderView('user', $params);
    }

    // Shared logic between rendering posts and comments of a particular user
    private function renderUserInfo(string $type): string {
        $username = $_GET['name'];

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = PAGE_LIMIT;

        $content = [];
        $contentHtml = '';
        $totalAmount = 0;

        function verifyAuthor(): bool {
            return (!empty($content[0]['author_id']) 
                    && !empty($_SESSION['account_id']) 
                    && $content[0]['author_id'] === $_SESSION['account_id']);
        }

        if ($type === 'posts') {
            $content = $this->postsModel->getPostsByUsername($username, $currentPage, $limit);
            $totalAmount = $this->postsModel->getAmountByUsername($username);
            $editable = false;

            verifyAuthor() ? $editable = true : $editable = false;

            foreach($content as $post) {
            $params = [
                'id' => $post['id'],
                'title' => $post['title'],
                'body' => $this->shortenStr($post['body']),
                'createdAt' => $this->formatDate($post['created_at']),
                'author' => $post['author_name'],
                'editable' => $editable,
                'deletable' => ($editable || $this->checkIfAdmin())
            ];
            $contentHtml .= View::show('postCard', $params, true);
            }
        } else {
            $content = $this->commentsModel->getCommentsByUsername($username, $currentPage, $limit);
            $totalAmount = $this->commentsModel->getAmountByUsername($username);
            $isAuthor = false;

            verifyAuthor() ? $editable = true : $editable = false;

            foreach($content as $comment) {
                $postTitle = $this->postsModel->getPostById($comment['post_id'])['title'];
                $params = [
                    'createdAt' => $this->formatDate($comment['created_at']),
                    'body' => $comment['body'],
                    'postTitle' => $postTitle,
                    'postId' => $comment['post_id'],
                    'commentId' => $comment['id'],
                    'isAuthor' => $isAuthor
                ];
                $contentHtml .= View::show('commentCard', $params, true);
            }
        }

        $totalPages = ceil($totalAmount / $limit);

        $paginationLinks = $this->generatePaginationLinks($currentPage, $totalPages, "?name=$username&page=");

        return $this->renderView("/user/$type", 
            ['username' => $username,
            'contentHtml' => $contentHtml, 
            'paginationLinks' => $paginationLinks
        ]);
    }

    public function renderMyPage(): string {
        if (!$this->checkIfLoggedin()) {
            return $this->renderView('404');
        }
        $name = $_SESSION['account_name'];
        return $this->renderUserPage(true, $name);
    }

    public function renderOtherUsersPage(): string {
        $name = $_GET['name'];
        // Redirecting to /my_page if the user's id is matching the logged in user's id
        if (!empty($_SESSION['account_name']) && $name === $_SESSION['account_name']) {
            header("Location: /my_page");
            exit;
        }
        return $this->renderUserPage(false, $name);
    }

    public function renderUserPosts(): string {
        return $this->renderUserInfo('posts');
    }

    public function renderUserComments(): string {
        return $this->renderUserInfo('comments');
    }
}