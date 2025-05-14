<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = $_POST['username'];
   $email = $_POST['email'];
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users_login (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Registration successful. You can now log in.";
        header("Location: login.php");
        exit();
    } else {
        $error = "Username or email already exists.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
   <title>Register</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
   <h2>Register</h2>

   <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
   <form method="POST">
      <div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control"
            required></div>
      <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control"
            required></div>   
      <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control"
            required></div>
      <button type="submit" class="btn btn-success">Register</button>
      <a href="login.php" class="btn btn-link">Login</a>
   </form>
</body>

</html>