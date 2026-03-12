<div class="mb-4">
    <div class="d-flex justify-content-between align-items-start gap-3">
        <h1 class="mb-5"><?= $title ?></h1>
        <div class="d-flex justify-content-between align-items-start gap-3">
            <?php if ($editable): ?>
                <a href=<?="/post/edit?id=$id"?> class="text-primary text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                    </svg>
                </a>
            <?php endif; ?>
            <?php if ($deletable): ?> 
                <a href=<?="/post/delete?id=$id"?> class="text-primary text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<div>
    <div class="mb-3">
        <p class="text-muted">Published by <a href="<?= '/user?name=' . $author ?>" class="text-decoration-none"><?= $author ?></a> on <?= $createdAt ?></p>
        <?php if ($updatedAt): ?><p class="text-muted">(updated on <?= $updatedAt ?>)</p><?php endif; ?>
    </div>
    <div class="mb-5">
        <?= $body ?>
    </div>
</div>

<div>
    <h2 class="mb-5">Comments</h2>
    <?php if (!empty($_SESSION['account_loggedin'])): ?>
        <form method="POST" class="w-75 mb-3">
            <textarea class="form-control mb-3" cols="30" rows="4" name="body" placeholder="Write your comment" required></textarea>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary ps-3 pe-3">Comment</button>
            </div>
        </form>
    <?php endif; ?>

    <?php if (!empty($allComments)): ?>
        <div class="d-flex flex-column w-75">
            <?= $allComments ?>
        </div>
    <?php else: ?>
        <p class="text-muted">There are no comments yet.</p>
    <?php endif; ?>
</div>