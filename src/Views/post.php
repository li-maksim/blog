<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center gap-3">
        <h1><?= $title ?></h1>
        <?php if ($editable): ?> 
            <div class="d-flex justify-content-between align-items-center">
                <a href=<?="/post/edit?id=$id"?> class="btn btn-primary me-2">Edit</a>
                <a href=<?="/post/delete?id=$id"?> class="btn btn-danger">Delete</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<div>
    <div class="mb-3">
        <p class="text-muted">Published by <a href="<?= '/user?name=' . $author ?>" class="text-decoration-none"><?= $author ?></a> on <?= $createdAt ?></p>
        <?php if ($updatedAt): ?><p class="text-muted">(updated on <?= $updatedAt ?>)</p><?php endif; ?>
    </div>
    <div class="border p-3 rounded mb-4">
        <?= $body ?>
    </div>
</div>

<div>
    <h2 class="mb-3">Comments</h2>
    <?php if (!empty($_SESSION['account_loggedin'])): ?>
        <form method="POST" class="mb-3">
            <textarea class="form-control" cols="50" rows="4" name="body" placeholder="Write your comment" required></textarea>
            <button type="submit" class="btn btn-primary mt-2">Comment</button>
        </form>
    <?php endif; ?>

    <?php if (!empty($allComments)): ?>
        <div class="d-flex flex-column gap-3">
            <?= $allComments ?>
        </div>
    <?php else: ?>
        <p class="text-muted">There are no comments yet.</p>
    <?php endif; ?>
</div>