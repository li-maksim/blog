<?php

namespace App\Controllers;

use App\View;
use App\Controller;
use App\DB;

class PostController extends Controller {

    public function render() {

        $pdo = DB::getInstance();
        $stmt = $pdo->query(
            'SELECT
                title, created_at, body
            FROM
                posts
            ORDER BY
                created_at DESC'
        );

        if ($stmt === false)
        {
            throw new Exception('There was a problem running this query');
        }

        $allTitles = $stmt->fetch()['title'];
        
        return $this->renderView('post', ['allTitles' => $allTitles]);
    }
}