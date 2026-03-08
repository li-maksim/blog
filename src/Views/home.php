<h1 class="text-center my-4 mb-5">Nice blog</h1>
<?php if (!empty($allPosts)): ?> 
    <div class="d-flex m-0 m-auto w-75 flex-column gap-3 align-items-center"><? echo $allPosts ?></div>
<?php else: ?>
    <p  class="alert alert-info text-center">There are no posts yet. You can create the first one!</p>
<?php endif; ?>
<nav>
    <?= $paginationLinks ?>
</nav>