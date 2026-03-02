<div class="card mb-4">
    <div class="card-body">
        <h2 class="card-title"><?= $title ?></h2>
        <p class="card-text">Published by 
            <a href="<?= '/user?name=' . $author ?>" class="text-decoration-none"><?= $author ?></a> on <?= $createdAt ?>
        </p>
        <?php if ($editable): ?>
            <div class="mb-3">
                <a href=<?="/post/edit?id=$id"?> class="btn btn-primary me-2">Edit</a>
                <a href=<?="/post/delete?id=$id"?> class="btn btn-danger">Delete</a>
            </div>
        <?php endif; ?>
        <div class="card-text"><?= $body ?></div>
        <a href="<?= "/post?id=$id" ?>" class="btn btn-link">Read more...</a>
    </div>
</div>