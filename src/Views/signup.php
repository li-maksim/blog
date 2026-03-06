<form method="post" class="w-25 m-0 m-auto mt-5">

    <h1 class="text-center mb-5">Sign Up</h1>

    <div class="mb-5">
        <div class="form-outline flex-fill mb-3">
            <input type="text" id="form3Example1c" class="form-control" name="username" placeholder="Username" required value="<?= htmlspecialchars($username ?? '') ?>" />
        </div>

        <div class="form-outline flex-fill mb-3">
            <input type="email" id="form3Example3c" class="form-control" name="email" placeholder="Email" required value="<?= htmlspecialchars($email ?? '') ?>" />
        </div>

        <div class="form-outline flex-fill mb-3">
            <input type="password" id="form3Example4c" class="form-control" placeholder="Password" name="password" required />
        </div>

        <div class="form-outline flex-fill">
            <input type="password" id="form3Example4cd" class="form-control" placeholder="Confirm password" name="conf_password" required />
        </div>
    </div>

    <?php if (isset($error) && !empty($error)): ?>
        <p class="text-danger text-center"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary pe-5 ps-5">Sign Up</button>
    </div>

</form>