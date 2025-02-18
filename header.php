<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduHub</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- Top Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="dashboard.php">
        <i class="fas fa-graduation-cap"></i> EduHub
      </a>
      
      <!-- Search Bar -->
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search notes...">
        <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
      </form>

      <!-- Dropdown Menu -->
      <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" id="mainMenu" data-bs-toggle="dropdown">
          <i class="fas fa-bars"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
          <li><a class="dropdown-item" href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
          <li><a class="dropdown-item" href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
          <li><a class="dropdown-item" href="downloads.php"><i class="fas fa-download"></i> Downloads</a></li>
          <li><a class="dropdown-item" href="blogs.php"><i class="fas fa-blog"></i> Blogs</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="admin/index.php"><i class="fas fa-lock"></i> Admin</a></li>
          <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>