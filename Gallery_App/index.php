<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Gallery App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">
  <style>
    body {
      background: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      border: none;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .card-body h6 {
      font-weight: 600;
    }

    .gallery-img:hover {
      opacity: 0.85;
      cursor: pointer;
    }

    .navbar {
      border-bottom: 1px solid #ddd;
    }

    .input-group>.form-control {
      border-radius: 0.5rem 0 0 0.5rem;
    }

    .input-group>.btn {
      border-radius: 0 0.5rem 0.5rem 0;
    }
  </style>
</head>

<body class="bg-light">
  <?php session_start(); ?>
  <nav class="navbar navbar-light bg-light mb-4">
    <div class="container-fluid">
      <span class="navbar-brand">Gallery App</span>
      <div>
        <?php if (isset($_SESSION['username'])): ?>
          Welcome, <?= $_SESSION['username']; ?> |
          <a href="logout.php" class="btn btn-outline-secondary btn-sm">Logout</a>
        <?php else: ?>
          <a href="login.php" class="btn btn-outline-primary btn-sm">Login</a>
          <a href="register.php" class="btn btn-primary btn-sm">Register</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>
  <div class="container py-5">
    <h2 class="mb-4 text-center">Image Gallery</h2>
    <!-- Search Form -->
    <form method="GET" class="mb-4">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search by title or user..."
          value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </div>
    </form>
    <!-- Upload Form -->
    <?php if (isset($_SESSION['user_id'])): ?>
      <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" class="form-control mb-2" placeholder="Title">
        <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
        <input type="file" name="image" class="form-control mb-2" required>
        <button type="submit" name="upload" class="btn btn-primary">Upload</button>
      </form>
    <?php else: ?>
      <p>Please <a href="login.php">login</a> to upload images.</p>
    <?php endif; ?>

    <!-- Gallery -->
    <div class="row">
      <?php
      $search = $_GET['search'] ?? '';
      $search_query = "";
      if (!empty($search)) {
        $search = $conn->real_escape_string($search);
        $search_query = "WHERE images.title LIKE '%$search%' OR users.username LIKE '%$search%'";
      }
      $sql = "SELECT images.*, users.username FROM images 
        JOIN users ON images.user_id = users.id 
        $search_query 
        ORDER BY uploaded_at DESC";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="col-md-3 mb-4"> 
    <div class="card shadow-sm"> 
        <img src="uploads/' . $row['filename'] . '" class="card-img-top img-thumbnail gallery-img"  
             data-bs-toggle="modal" data-bs-target="#modal' . $row['id'] . '" style="height:200px;object
fit:cover;"> 
        <div class="card-body"> 
            <h6>' . htmlspecialchars($row['title']) . '</h6> 
            <p class="text-muted small">' . htmlspecialchars($row['description']) . '</p> 
            <p class="small">By: <strong>' . $row['username'] . '</strong></p>';

        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id']) {
          echo '<form action="delete.php" method="POST" onsubmit="return confirm(\'Delete this 
image?\')"> 
                    <input type="hidden" name="id" value="' . $row['id'] . '"> 
                    <input type="hidden" name="filename" value="' . $row['filename'] . '"> 
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button> 
                </form>';
        }

        echo '</div> 
        </div> 
</div>

<!-- Modal --> 
<div class="modal fade" id="modal' . $row['id'] . '" tabindex="-1"> 
  <div class="modal-dialog modal-dialog-centered modal-lg"> 
    <div class="modal-content"> 
      <div class="modal-body p-0"> 
        <img src="uploads/' . $row['filename'] . '" class="w-100"> 
      </div> 
      <div class="modal-footer justify-content-between"> 
        <div> 
            <strong>' . htmlspecialchars($row['title']) . '</strong><br> 
            <small>' . htmlspecialchars($row['description']) . '</small><br> 
            <em>Uploaded by: ' . $row['username'] . '</em> 
        </div> 
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
      </div> 
    </div> 
  </div> 
</div>';
      }
      ?>
    </div>
  </div>
</body>

</html>