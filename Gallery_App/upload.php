<?php 
include 'config.php'; 
session_start(); 
?>

<?php if (isset($_SESSION['user_id'])): ?> 
<!-- Upload form --> 
<?php else: ?> 
<!-- Skip form --> 
<?php endif; ?> 

<?php if (isset($_POST['upload']) && isset($_SESSION['user_id'])) { 
$image = $_FILES['image']['name']; 
$title = $_POST['title']; 
$desc  = $_POST['description']; 
$user_id = $_SESSION['user_id']; 
$target = "uploads/" . basename($image); 
if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) { 
$stmt = $conn->prepare("INSERT INTO images (user_id, filename, title, description) VALUES (?, ?, 
?, ?)"); 
$stmt->bind_param("isss", $user_id, $image, $title, $desc); 
$stmt->execute(); 
} 
} 
header("Location: index.php"); 
?>