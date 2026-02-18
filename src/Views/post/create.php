<h1>Create post</h1>
    		
<form action="" method="POST">
    
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($oldTitle ?? '') ?>" />
    </div>
    
    <div class="form-group">
        <label for="body">Description</label>
        <textarea rows="8" class="form-control" name="body" ><?= htmlspecialchars($oldBody ?? '') ?></textarea>
    </div>
    
    <div class="form-group mt-2">
        <button type="submit" class="btn btn-primary">
            <?= $btnText ?>
        </button>
        <a href="/" class="btn btn-default">
            Cancel
        </a>
    </div>
    
</form>