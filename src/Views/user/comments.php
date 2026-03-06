<h1 class="text-center my-4"><?= $username . "'s comments" ?></h1>
<?php if (!empty($allComments)): ?> 
    <div class="d-flex flex-column gap-3"><?= $allComments ?></div>
<?php else: ?>
    <p class="alert alert-info text-center mt-4">There are no comments yet.</p>
<?php endif; ?>