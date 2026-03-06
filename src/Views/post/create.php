<h1 class="text-center mb-5">
    <?php if ($edit): ?>
        <?= "Edit Post" ?>
    <?php else: ?>
        <?= "Create Post" ?>
    <?php endif; ?>
</h1>

<form method="POST">
    <div class="mb-3">
        <label for="title" class="form-label fw-bold">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= htmlspecialchars($oldTitle ?? '') ?>" maxlength="80" required />
    </div>
    
    <div class="mb-3">
        <label for="body" class="form-label fw-bold">Description</label>
        <textarea rows="8" class="form-control" name="body" id="body" required><?= htmlspecialchars($oldBody ?? '') ?></textarea>
    </div>
    
    <div class="d-flex justify-content-end gap-3">
        <button type="submit" class="btn btn-primary w-200px">
            <?php if ($edit): ?>
                <?= "Edit" ?>
            <?php else: ?>
                <?= "Create" ?>
            <?php endif; ?>
        </button>
        <a href="/" class="btn btn-danger w-200px">
            Cancel
        </a>
    </div>
</form>
