<div class="flex">
    <h1><?php echo $title ?></h1>
    <?php if ($editable): ?> 
        <a href=<?="/post/edit?id=$id"?> class="btn btn-primary">Edit</a>
        <a href=<?="/post/delete?id=$id"?> class="btn btn-primary">Delete</a>
    <?php endif; ?>
</div>
<div>
    <div>
        <p>Published by <?php echo $author ?> on <?php echo $createdAt ?></p>
        <?php if ($updatedAt): ?><p>(updated on <?= $updatedAt ?>)</p><?php endif; ?>
    </div>
    <div><?php echo $body ?></div>
</div>
<div>
    <h2>Comments</h2>
    <p>There are no coments yet.</p>
</div>