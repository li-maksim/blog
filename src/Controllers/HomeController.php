<?php

namespace App\Controllers;

use App\View;
use App\Controller;
use App\Models\Posts;

class HomeController extends Controller {

    private Posts $postsModel;

    public function __construct() {
        $this->postsModel = new Posts();
    }

    public function render() {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = PAGE_LIMIT;

        $postsData = $this->postsModel->getAllPosts($currentPage, $limit);
        $totalPosts = $this->postsModel->getAmountOfPosts();
        $totalPages = ceil($totalPosts / $limit);
        $allPosts = '';
        
        foreach($postsData as $post) {
            $editable = (!empty($_SESSION['account_name']) && $_SESSION['account_name'] === $post['author_name']);
            $params = [
                'id' => $post['id'],
                'title' => $post['title'],
                'body' => $this->shortenStr($post['body']),
                'createdAt' => $this->formatDate($post['created_at']),
                'author' => $post['author_name'],
                'editable' => $editable,
                'deletable' => ($editable || $this->checkIfAdmin())
            ];
            $allPosts .= View::show('postCard', $params, true);
        }

        $paginationLinks = $this->generatePaginationLinks($currentPage, $totalPages);

        return $this->renderView('home', ['allPosts' => $allPosts, 'paginationLinks' => $paginationLinks]);
    }
}