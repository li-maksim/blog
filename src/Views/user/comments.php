<h1><?= $username . "'s comments" ?></h1>
<hr>
<?php if (!empty($allComments)): ?> 
    <div class="d-flex flex-column gap-3"><?= $allComments ?></div>
<?php else: ?>
    <p>There are no comments yet.</p>
<?php endif; ?>