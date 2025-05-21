<?php
include 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $conn->real_escape_string($_POST['username']);
  $password = $_POST['password'];

  $result = $conn->query("SELECT * FROM users WHERE username = '$username'");

  if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      header("Location: index.php");
      exit();
    } else {
      $error = "Invalid password.";
    }
  } else {
    $error = "User not found.";
  }
}
?>

<?php include 'includes/header.php'; ?>

<div class="container mt-4">
  <h2>Login</h2>
  <?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>
  <form method="POST">
    <div class="mb-3"><input type="text" name="username" class="form-control"
        placeholder="Username" required></div>
    <div class="mb-3"><input type="password" name="password" class="form-control"
        placeholder="Password" required></div>
    <button class="btn btn-primary">Login</button>
    <a href="register.php" class="btn btn-link">Register</a>
  </form>
</div>

<?php include 'includes/footer.php'; ?>