<?php 
include('includes/db.php'); 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
$username = $_POST['username']; 
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
$role = $_POST['role']; 
$check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'"); 
if (mysqli_num_rows($check) > 0) { 
$error = "Username already exists!"; 
} else { 
mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', 
'$password', '$role')"); 
$_SESSION['success'] = "Registration successful! Please login."; 
header("Location: login.php"); 
exit(); 
} 
} 
?>

<!DOCTYPE html> 
<html> 
<head> 
  <title>Register</title> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet"> 
</head>

<body class="p-5"> 
<div class="container"> 
    <form method="POST" class="w-50 mx-auto"> 
        <h3>Register</h3> 
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?> 
        <input type="text" name="username" class="form-control mb-2" placeholder="Username" 
required> 
        <input type="password" name="password" class="form-control mb-2" 
placeholder="Password" required> 
        <select name="role" class="form-control mb-2"> 
            <option value="admin">Admin</option> 
            <option value="user">User</option> 
        </select> 
        <button class="btn btn-success">Register</button> 
        <p class="mt-3">Already registered? <a href="login.php">Login</a></p> 
    </form> 
</div> 
</body> 
</html> 