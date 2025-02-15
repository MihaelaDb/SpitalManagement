<?php
// app/views/header.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Spital Management</title>
  <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="?page=home">Spital Management</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if(isset($_SESSION['user'])): ?>
          <?php if($_SESSION['user']['role'] == 'doctor'): ?>
            <li class="nav-item">
              <a class="nav-link" href="?page=appointments">All Appointments</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="?page=appointments">My Appointments</a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="?page=logout">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="?page=login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=register">Register</a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href="?page=documentation">Documentation</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-4">
