<h1 class="text-center mb-5"><?= $username . "'s Posts" ?></h1>
<?php if (!empty($contentHtml)): ?> 
    <div class="container">
        <div class="d-flex flex-column gap-3">
            <?= $contentHtml ?>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-info text-center">
        There are no posts yet.
    </div>
<?php endif; ?>
<nav>
    <?= $paginationLinks ?>
</nav>