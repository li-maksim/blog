<div>
    <div class="flex">
        <p>On <?= $createdAt ?></p>
        <a href="<?= '/comment/delete?id=' . $commentId ?>" class="btn btn-primary">Delete</a>
    </div>
    <div><?= $body ?></div>
    <a href="<?= '/post?id=' . $postId ?>">Full post</a>
</div>