<?php
include 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $email    = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
  
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $username, $email, $password);
  if ($stmt->execute()) {
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else {
    echo "Registration failed.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>
<body>
  <!-- HTML Form --> 
<form method="POST"> 
<input type="text" name="username" required placeholder="Username"> 
<input type="email" name="email" required placeholder="Email"> 
<input type="password" name="password" required placeholder="Password"> 
<button type="submit">Register</button> 
</form>
</body>
</html>
 

