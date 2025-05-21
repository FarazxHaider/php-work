<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Gallery App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      padding-top: 70px;
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar-brand {
      font-weight: bold;
    }

    .card-img-top {
      height: 250px;
      object-fit: cover;
      cursor: pointer;
    }

    .card-title {
      font-weight: 600;
      font-size: 1.1rem;
    }

    .card-text {
      font-size: 0.95rem;
    }

    .alert {
      font-size: 0.9rem;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Gallery App</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <?php if (isset($_SESSION['username'])): ?>
            <a class="nav-link" href="#">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></a>
            <a class="nav-link" href="upload_form.php">Upload</a>
            <a class="nav-link" href="logout.php">Logout</a>
          <?php else: ?>
            <a class="nav-link" href="login.php">Login</a>
            <a class="nav-link" href="register.php">Register</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>