<h1 class="text-center my-4">Nice blog</h1>
<?php if (!empty($allPosts)): ?> 
    <div class="d-flex flex-column gap-3"><? echo $allPosts ?></div>
<?php else: ?>
    <p  class="alert alert-info text-center">There are no posts yet. You can create the first one!</p>
<?php endif; ?>