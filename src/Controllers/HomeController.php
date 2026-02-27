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
        $postsData = $this->postsModel->getAllPosts();
        
        $allPosts = '';
        
        foreach($postsData as $post) {
            $params = [
                'id' => $post['id'],
                'title' => $post['title'],
                'body' => $this->shortenStr($post['body']),
                'createdAt' => $this->formatDate($post['created_at']),
                'author' => $post['author_name']
            ];
            $allPosts .= View::show('postCard', $params, true);
        }

        return $this->renderView('home', ['allPosts' => $allPosts]);
    }
}