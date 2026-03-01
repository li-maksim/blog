<div>
    <h2><?= $title ?></h2>
        <p>Published by <a href="<?= '/user?name=' . $author ?>"><?= $author ?></a> on <?= $createdAt ?></p>
        <?php if ($editable): ?>
            <div>
                <a href=<?="/post/edit?id=$id"?> class="btn btn-primary">Edit</a>
                <a href=<?="/post/delete?id=$id"?> class="btn btn-primary">Delete</a>
            </div>
        <?php endif; ?>
    <div><?= $body ?></div>
    <a href="<?= "/post?id=$id" ?>">Read more...</a>
</div>