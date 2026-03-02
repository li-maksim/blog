<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="text-muted">By <a href="<?= '/user?name=' . $author ?>" class="text-decoration-none"><?= $author ?></a> on <?= $createdAt ?></div>
            <?php if ($isAuthor): ?>
                <a href="<?= '/comment/delete?id=' . $commentId ?>" class="btn btn-danger btn-sm">Delete</a>
            <?php endif; ?>
        </div>
        <div><?= $body ?></div>
    </div>
</div>