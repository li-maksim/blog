<div>
    <div>
        <div>By <a href="<?= '/user?name=' . $author ?>"><?= $author ?></a> on <?= $createdAt ?> </div>
        <?php if ($isAuthor): ?>
            <a href="<?= '/comment/delete?id=' . $commentId ?>" class="btn btn-primary">Delete</a>
        <?php endif; ?>
    </div>
    <div><?= $body ?></div>
</div>