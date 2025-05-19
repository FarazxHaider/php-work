<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $res = $stmt->get_result();

  if ($res->num_rows == 1) {
    $user = $res->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      header("Location: index.php");
    } else {
      echo "Wrong password!";
    }
  } else {
    echo "User not found.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>

<body>
  <!-- HTML Form -->
  <form method="POST">
    <input type="text" name="username" required placeholder="Username">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit">Login</button>
  </form>
</body>

</html>