<?php include 'header.php'; ?>
<div class="jumbotron">
  <h1 class="display-4">Welcome to Spital Management</h1>
  <p class="lead">Manage appointments easily and efficiently.</p>
  <?php if(isset($_SESSION['user'])): ?>
    <p>You are logged in as <strong><?php echo htmlspecialchars($_SESSION['user']['name']); ?></strong>.</p>
  <?php else: ?>
    <p>Please <a href="?page=login">login</a> or <a href="?page=register">register</a> to continue.</p>
  <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
