<?php
 include 'db_connect.php';
 $name = $_POST['name'];
 $email = $_POST['email'];
 $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
 if ($conn->query($sql) === TRUE) {
    echo "Data submitted successfully.";
 } else {
    echo "Error: " . $conn->error;
 }
 $conn->close();
 ?>
