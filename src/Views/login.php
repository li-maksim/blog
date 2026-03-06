<form method="post" class="w-25 m-0 m-auto mt-5">
    <h1 class="text-center mb-5">Log In</h2>

    <div class="form-outline mb-3">
        <input type="email" id="form2Example1" class="form-control" name="email" placeholder="Email" data-bs-toggle="tooltip" data-bs-placement="right" title="Email" required value="<?= htmlspecialchars($email ?? '') ?>" />
    </div>

    <div class="form-outline mb-5">
        <input type="password" id="form2Example2" class="form-control" name="password" placeholder="Password" data-bs-toggle="tooltip" data-bs-placement="right" title="Password" required />
    </div>

    <?php if ($error): ?>
        <p class="text-danger text-center"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <div class="d-flex justify-content-center mb-3">
        <button type="submit" class="btn btn-primary ps-5 pe-5">Log in</button>
    </div>

    <div class="text-center">
        <p>Not a member? <a href="/signup" class="link-primary text-decoration-none">Register</a></p>
    </div>
</form>
