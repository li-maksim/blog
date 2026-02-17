<div>
    <h2><?php echo $title ?></h2>
    <div>Published by <?php echo $author ?> on <?php echo $createdAt ?> </div>
    <div><?php echo $body ?></div>
    <a href="<?= "/post?id=$id" ?>">Read more...</a>
</div>