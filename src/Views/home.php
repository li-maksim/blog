<h1>Nice blog</h1>
<hr>
<?php if (!empty($allPosts)): ?> 
    <div class="d-flex flex-column gap-3"><? echo $allPosts ?></div>
<?php else: ?>
    <p>There are no posts yet. You can create the first one!</p>
<?php endif; ?>