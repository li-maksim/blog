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
    <?php if (!empty($_SESSION['account_loggedin'])): ?>
        <form method="POST">
            <textarea cols="50" rows="8" name="body" placeholder="Write your comment" required></textarea>
            <button type="submit" class="btn btn-primary">Comment</button>
        </form>
    <?php endif; ?>
    <?php if (!empty($allComments)): ?>
        <div class="d-flex flex-column gap-3"><? echo $allComments ?></div>
    <?php  else: ?>
        <p>There are no comments yet.</p>
    <?php endif; ?>
</div>