<?php 
include('includes/db.php'); 
session_start(); 
$id = $_GET['id']; 
mysqli_query($conn, "DELETE FROM students WHERE id=$id"); 
$_SESSION['message'] = "Student deleted successfully!"; 
header("Location: index.php"); 
exit(); 
?>