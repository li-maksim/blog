<div>
    <h2><?= $title ?></h2>
        <p>Published by <a href="<?= '/user?name=' . $author ?>"><?= $author ?></a> on <?= $createdAt ?></p>
    <div><?= $body ?></div>
    <a href="<?= "/post?id=$id" ?>">Read more...</a>
</div>