<?php
include 'config.php';
if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] != 'POST') {
  header("Location: login.php");
  exit();
}
$id = intval($_POST['id']);
$filename = $_POST['filename'];
$check = $conn->prepare("SELECT * FROM images WHERE id = ? AND user_id = ?");
$check->bind_param("ii", $id, $_SESSION['user_id']);
$check->execute();
$result = $check->get_result();
if ($result->num_rows > 0) {
  $conn->query("DELETE FROM images WHERE id = $id");
  if (file_exists("uploads/$filename")) {
    unlink("uploads/$filename");
  }
}
header("Location: index.php");
