<h1 class="text-center my-4">
    <?php if ($edit): ?>
        <?= "Edit Post" ?>
    <?php else: ?>
        <?= "Create Post" ?>
    <?php endif; ?>
</h1>

<form action="" method="POST">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= htmlspecialchars($oldTitle ?? '') ?>" maxlength="80" required />
    </div>
    
    <div class="mb-3">
        <label for="body" class="form-label">Description</label>
        <textarea rows="8" class="form-control" name="body" id="body" required><?= htmlspecialchars($oldBody ?? '') ?></textarea>
    </div>
    
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">
            <?php if ($edit): ?>
                <?= "Edit" ?>
            <?php else: ?>
                <?= "Create" ?>
            <?php endif; ?>
        </button>
        <a href="/" class="btn btn-secondary">
            Cancel
        </a>
    </div>
</form>
