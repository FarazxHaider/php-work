 <?php
  include 'config.php';

  session_start();
  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
  }
  $id = $_GET['id'];
  $conn->query("DELETE FROM users WHERE id=$id");
  header("Location: index.php");
  ?>