<h1><?= $username . "'s posts" ?></h1>
<hr>
<?php if (!empty($allPosts)): ?> 
    <div class="d-flex flex-column gap-3"><? echo $allPosts ?></div>
<?php else: ?>
    <p>There are no posts yet.</p>
<?php endif; ?>