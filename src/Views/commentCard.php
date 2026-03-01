<div>
    <div class="flex">
        <p>On <?= $createdAt ?></p>
        <?php if ($isAuthor): ?>
            <a href="<?= '/comment/delete?id=' . $commentId ?>" class="btn btn-primary">Delete</a>
        <?php endif; ?>
    </div>
    <div><?= $body ?></div>
    <a href="<?= '/post?id=' . $postId ?>">Full post</a>
</div>