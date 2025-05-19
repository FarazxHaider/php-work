<?php 
include 'config.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
$id = $_POST['id']; 
$filename = $_POST['filename']; 
// Delete from folder 
unlink("uploads/" . $filename); 
// Delete from DB 
$sql = "DELETE FROM images WHERE id = $id"; 
mysqli_query($conn, $sql); 
} 
header("Location: index.php"); 
?> 
