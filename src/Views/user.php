<h1 class="text-center my-4">
    <?php if (!$myPage): ?>
        <?= $username . "'s page" ?>
    <?php else: ?>
        My Page 
    <?php endif; ?>
</h1>

<div class="container mb-4">
    <div class="row text-center">
        <div class="col-md-6">
            <h2>Posts</h2>
            <?php if ($postsNum > 0): ?>
                <p><?= $postsNum ?> <a href="<?= '/user/posts?name=' . $username ?>" class="text-decoration-none">posts</a></p>
            <?php else: ?>
                <p>0 posts yet.</p>
            <?php endif; ?>
        </div>
        
        <div class="col-md-6">
            <h2>Comments</h2>
            <?php if ($commentsNum > 0): ?>
                <p><?= $commentsNum ?> <a href="<?= '/user/comments?name=' . $username ?>" class="text-decoration-none">comments</a></p>
            <?php else: ?>
                <p>0 comments yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>