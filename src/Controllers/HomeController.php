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

    private function shortenStr(string $str): string {
        if (strlen($str) > 250) {
            return substr($str, 0, 250) . '...';
        } else {
            return $str;
        }
    }

    public function render() {
        $postsData = $this->postsModel->getAllPosts();
        
        $allPosts = '';
        
        foreach($postsData as $post) {

            $params = [
                'title' => $post['title'],
                'body' => $this->shortenStr($post['body']),
                'createdAt' => $post['created_at'],
                'author' => $post['author_id']
            ];
            $allPosts .= View::show('postCard', $params, true);
        }

        return $this->renderView('home', ['allPosts' => $allPosts]);
    }
}