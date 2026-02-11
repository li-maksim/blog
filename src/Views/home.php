<h1>Nice blog</h1>
<hr>
<?php 
    if (!empty($allPosts)) {
        $posts = <<<POSTS
        <div class="d-flex flex-column gap-3">$allPosts</div>
        POSTS;
        echo $posts;
    } else {
        echo "<p>There are no posts yet. You can create the first one!</p>";
    }
?>