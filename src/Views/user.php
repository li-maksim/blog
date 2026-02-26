<h1>
    <?php if (!$myPage): ?>
    <?= $username . "'s page" ?>
    <?php else: ?>
    My Page 
    <?php endif; ?>
</h1>
<div class="flex">
    <div>
        <h2>Posts</h2>
        <?php if ($postsNum > 0): ?>
            <p><?= $postsNum ?> <a href="<?= '/user/' . $username . '/posts' ?>">posts</a></p>
        <?php else: ?>
            <p>0 posts yet.</p>
        <?php endif; ?>
    </div>
    <div>
        <h2>Comments</h2>
        <?php if ($commentsNum > 0): ?>
            <p><?= $commentsNum ?> <a href="<?= '/user/' . $username . '/comments' ?>">comments</a></p>
        <?php else: ?>
            <p>0 comments yet.</p>
        <?php endif; ?>
    </div>
    <?php if ($myPage): ?>
        <div>
            <a href="/logout" class="btn btn-secondary">Log Out</a> 
        </div> 
    <?php endif; ?>
</div>