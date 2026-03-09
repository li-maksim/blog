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
            <?php if ($postsNum > PAGE_LIMIT): ?>
                <div class="d-flex justify-content-center">
                    <a href="<?= '/user/posts?name=' . $username ?>" class="text-decoration-none text-center">All<?= " $postsNum " ?>posts</a>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="col-md-6">
            <h2 class="text-center mb-5">Comments</h2>
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
            <?php if ($commentsNum > PAGE_LIMIT): ?>
                <div class="d-flex justify-content-center">
                    <a href="<?= '/user/posts?name=' . $username ?>" class="text-decoration-none text-center">All<?= " $commentsNum " ?>comments</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>