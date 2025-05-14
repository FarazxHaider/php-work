<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $stmt = $conn->prepare("SELECT id, password FROM users_login WHERE username=?");
  $stmt->bind_param("s", $username);
  $stmt->execute();

  $stmt->store_result();


   if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['login_message'] = "Welcome! You are now logged in.";
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
<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
  <h2>Login</h2>
  <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <form method="POST">
    <div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control"
        required></div>
    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control"
        required></div>
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="register.php" class="btn btn-link">Register</a>
     <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
  </form>
</body>

</html>