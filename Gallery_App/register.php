<?php
include 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $conn->real_escape_string($_POST['username']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $exists = $conn->query("SELECT id FROM users WHERE username = '$username'");
  if ($exists->num_rows > 0) {
    $error = "Username already taken.";
  } else {
    $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
    header("Location: login.php");
    exit();
  }
}
?>

<?php include 'includes/header.php'; ?>

<div class="container mt-4">
  <h2>Register</h2>
  <?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>
  <form method="POST">
    <div class="mb-3"><input type="text" name="username" class="form-control"
        placeholder="Username" required></div>
    <div class="mb-3"><input type="password" name="password" class="form-control"
        placeholder="Password" required></div>
    <button class="btn btn-primary">Register</button>
    <a href="login.php" class="btn btn-link">Login</a>
  </form>
</div>

<?php include 'includes/footer.php'; ?>