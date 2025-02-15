<?php include __DIR__ .'/../header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h2>Register</h2>
    <!-- Registration form -->
    <form action="?page=register" method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" name="name" id="name" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" id="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" required>
      </div>
      <div class="mb-3">
        <label for="role" class="form-label">Register as</label>
        <select class="form-select" name="role" id="role" required>
          <option value="user">User</option>
          <option value="doctor">Doctor</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <p class="mt-3">Already have an account? <a href="?page=login">Login here</a>.</p>
  </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
