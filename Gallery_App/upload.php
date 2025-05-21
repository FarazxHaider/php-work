<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
  $title = $conn->real_escape_string($_POST['title']);
  $desc = $conn->real_escape_string($_POST['description']);
  $user_id = $_SESSION['user_id'];

  $filename = basename($_FILES["image"]["name"]);
  $target_file = "uploads/" . time() . "_" . $filename;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $valid_types = ['jpg', 'jpeg', 'png', 'gif'];

  if (!in_array($imageFileType, $valid_types)) {
    echo "Invalid file type.";
    exit;
  }

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $stmt = $conn->prepare("INSERT INTO images (user_id, title, description, filename) VALUES (?, ?, ?, 
?)");
    $stmt->bind_param("isss", $user_id, $title, $desc, basename($target_file));
    $stmt->execute();
    header("Location: index.php");
  } else {
    echo "Failed to upload image.";
  }
}
