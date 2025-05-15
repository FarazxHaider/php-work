<?php 
include('includes/db.php'); 
session_start(); 
if (!isset($_SESSION['user'])) { 
header("Location: login.php"); 
exit(); 
} 
$id = $_GET['id']; 
$query = mysqli_query($conn, "SELECT * FROM students WHERE id=$id"); 
$data = mysqli_fetch_assoc($query); 
if ($_SERVER['REQUEST_METHOD'] == "POST") { 
$name = $_POST['name']; 
$roll = $_POST['roll_number']; 
$class = $_POST['class']; 
$email = $_POST['email']; 
$contact = $_POST['contact']; 
mysqli_query($conn, "UPDATE students SET name='$name', roll_number='$roll', class='$class', 
email='$email', contact='$contact' WHERE id=$id"); 
$_SESSION['message'] = "Student updated successfully!"; 
header("Location: index.php"); 
exit(); 
} 
?> 
<!DOCTYPE html> 
<html> 
<head> 
<title>Edit Student</title> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet"> 
</head> 
<body class="p-5"> 
<div class="container"> 
<h3>Edit Student</h3> 
<form method="POST"> 
<input name="name" class="form-control mb-2" value="<?= $data['name'] ?>" required> 
<input name="roll_number" class="form-control mb-2" value="<?= $data['roll_number'] ?>" 
required> 
<input name="class" class="form-control mb-2" value="<?= $data['class'] ?>"> 
<input name="email" class="form-control mb-2" value="<?= $data['email'] ?>"> 
<input name="contact" class="form-control mb-2" value="<?= $data['contact'] ?>"> 
<button class="btn btn-primary">Update</button> 
<a href="index.php" class="btn btn-secondary">Cancel</a> 
</form> 
</div> 
</body> 
</html> 