<h1 class="text-center mb-5"><?= $username . "'s comments" ?></h1>
<?php if (!empty($contentHtml)): ?> 
    <div class="d-flex flex-column gap-3"><?= $contentHtml ?></div>
<?php else: ?>
    <p class="alert alert-info text-center mt-4">There are no comments yet.</p>
<?php endif; ?>
<nav>
    <?= $paginationLinks ?>
</nav>