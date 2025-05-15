<?php 
include('includes/db.php'); 
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = $_POST['username']; 
    $password = $_POST['password']; 
 
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'"); 
    $user = mysqli_fetch_assoc($query); 

      if ($user && password_verify($password, $user['password'])) { 
        $_SESSION['user'] = $user; 
        header("Location: index.php"); 
        exit(); 

         } else { 
        $error = "Invalid credentials!"; 
    } 
} 
?>


<!DOCTYPE html> 
<html> 
<head> 
  <title>Login</title> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet"> 
</head> 
<body class="p-5"> 
<div class="container"> 
    <form method="POST" class="w-50 mx-auto"> 
        <h3>Login</h3> 
        <?php 
        if (isset($_SESSION['success'])) { 
            echo "<div class='alert alert-success'>{$_SESSION['success']}</div>"; 
            unset($_SESSION['success']); 
        } 
        if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; 
        ?> 
        <input type="text" name="username" class="form-control mb-2" placeholder="Username" 
required> 
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" 
required> 
        <button class="btn btn-primary">Login</button> 
        <p class="mt-3">Don't have an account? <a href="register.php">Register</a></p> 
    </form> 
</div> 
</body> 
</html> 