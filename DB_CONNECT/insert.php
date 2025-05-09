<?php
 include 'db_connect.php';
 
 $name = "Asad";
 $email = "asad@gmail.com";
 $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
 if ($conn->query($sql) === TRUE){
    echo "New record inserted successfully";
 } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
 }
 $conn->close();
 ?>