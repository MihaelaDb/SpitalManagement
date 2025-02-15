<?php include __DIR__ .'/../header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h2>Login</h2>
    <!-- Login form -->
    <form action="?page=login" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" id="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p class="mt-3">Don't have an account? <a href="?page=register">Register here</a>.</p>
  </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
