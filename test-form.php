<!DOCTYPE HTML>  
<html>
<head>

<style>
.error{
  color: red;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
</style>
</head>
<body>  

<?php
// define variables and set to empty values

$nameErr = $emailErr = $genderErr = $commentErr = $websiteErr = "";

$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(empty($_POST["name"])){
  $nameErr = "Name is Required";
}else{
  $name = test_input($_POST["name"]);

  if(!preg_match("/^[a-zA-Z-']*$/",$name)){
    $nameErr = "Only letters and whitespace allowed";
  }

}
if(empty($_POST["email"])){
  $emailErr = "Email is Required";
}else{
  $email = test_input($_POST["email"]);

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $emailErr = "Invalid email format";
  }
}
if(empty($_POST["website"])){
  $wesbiteErr = "Website is Required";
}else{
  $website = test_input($_POST["website"]);

  if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
    $websiteErr = "Invalid URL";
  }
}
if(empty($_POST["comment"])){
  $commentErr = "Comment is Required";
}else{
  $comment = test_input($_POST["comment"]);
}  
if(empty($_POST["gender"])){
  $genderErr = "Gender is Required";
}else{
  $gender = test_input($_POST["gender"]);
}
}  
  
  

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr; ?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr; ?></span>
  <br><br>
  Website: <input type="text" name="website">
  <span class="error">* <?php echo $websiteErr; ?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class="error">* <?php echo $genderErr; ?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>