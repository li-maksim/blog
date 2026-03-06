<h1 class="text-center mb-5">
    <?php if (!$myPage): ?>
        <?= $username . "'s page" ?>
    <?php else: ?>
        My Page 
    <?php endif; ?>
</h1>

<div class="container mb-3">
        <?php if($myPage): ?>
            <div>
                <p><b>Username:</b> <?= $username ?></p>
                <p><b>Email:</b> <?= $email ?></p>
            </div>
        <?php endif; ?>
    <div class="row">
        <div class="col-md-6">
            <h2 class="text-center mb-5">Posts</h2>
            <?php if ($postsNum > 0): ?>
                <p class="text-center"><?= $postsNum ?> <a href="<?= '/user/posts?name=' . $username ?>" class="text-decoration-none">posts</a></p>
            <?php endif; ?>
            <?php if (!empty($allPosts)): ?> 
                <div class="container">
                    <div class="d-flex flex-column gap-3">
                        <?= $allPosts ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center">
                    There are no posts yet.
                </div>
            <?php endif; ?>
        </div>
        
        <div class="col-md-6">
            <h2 class="text-center mb-5">Comments</h2>
            <?php if ($commentsNum > 0): ?>
                <p class="text-center"><?= $commentsNum ?> <a href="<?= '/user/comments?name=' . $username ?>" class="text-decoration-none">comments</a></p>
            <?php endif; ?>
            <?php if (!empty($allComments)): ?> 
                <div class="container">
                    <div class="d-flex flex-column gap-3">
                        <?= $allComments ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center">
                    There are no comments yet.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>