<?php
include('includes/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $name = $_POST['name'];
  $roll = $_POST['roll_number'];
  $class = $_POST['class'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $query = "INSERT INTO students (name, roll_number, class, email, contact)  
VALUES ('$name', '$roll', '$class', '$email', '$contact')";
  mysqli_query($conn, $query);
  $_SESSION['message'] = "Student added successfully!";
  header("Location: index.php");
  exit();
}
