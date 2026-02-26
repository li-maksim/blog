<div>
    <h2><?php echo $title ?></h2>
        <p>Published by <a href="<?= '/user?name=' . $author ?>"><? echo $author ?></a> on <?php echo $createdAt ?></p>
    <div><?php echo $body ?></div>
    <a href="<?= "/post?id=$id" ?>">Read more...</a>
</div>