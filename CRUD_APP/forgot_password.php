 <?php
 include 'config.php';
 session_start();

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $stmt = $conn->prepare("SELECT id FROM users_login WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['reset_email'] = $email;
        header("Location: reset_password.php");
        exit();
    } else {
        $error = "Email not found.";
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
  <h2>Forget Password</h2>
  <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <form method="POST">
    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control"
        required></div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</body>

</html>

