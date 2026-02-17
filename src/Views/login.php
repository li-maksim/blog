<form method="post" class="w-25 m-0 m-auto">
  <!-- Email input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="email" id="form2Example1" class="form-control" name="email" value="<?= htmlspecialchars($email ?? '') ?>"/>
    <label class="form-label" for="form2Example1">Email</label>
  </div>

  <!-- Password input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="password" id="form2Example2" class="form-control" name="password" />
    <label class="form-label" for="form2Example2">Password</label>
  </div>

  <?php if ($error) echo "<p class='text-danger'>$error</p"; ?>

  <!-- Submit button -->
  <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Log in</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member? <a href="/signup">Register</a></p>

    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
      <i class="fab fa-google"></i>
    </button>

    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
      <i class="fab fa-twitter"></i>
    </button>

    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
      <i class="fab fa-github"></i>
    </button>
  </div>
</form>