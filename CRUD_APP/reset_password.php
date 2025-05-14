 <?php
 include 'config.php';
 session_start();

  if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
 }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_SESSION['reset_email'];
    $stmt = $conn->prepare("UPDATE users_login SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $new_password, $email);
    if ($stmt->execute()) {
        unset($_SESSION['reset_email']);
        $_SESSION['message'] = "Password has been reset successfully.";
        header("Location: login.php");
        exit();
    } else {
        $error = "Failed to reset password.";
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
  <h2>Reset Password</h2>
  <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <form method="POST">
    <div class="mb-3"><label>New Password</label><input type="password" name="password" class="form-control"
        required></div>
    <button type="submit" class="btn btn-primary">Reset Password</button>
    <a href="login.php" class="btn btn-link">Back to Login</a>
  </form>
</body>

</html>




