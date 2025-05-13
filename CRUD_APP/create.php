<?php include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fn = $_POST['first_name'];
  $ln = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  if (!empty($fn) && !empty($ln) && filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match(
    '/^\d{11}$/',
    $phone
  )) {
    $conn->query("INSERT INTO users (first_name, last_name, email, phone) VALUES ('$fn', '$ln', '$email',
 '$phone')");
    header("Location: index.php");
  } else {
    $error = "Please fill out the form correctly.";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Add User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
  <h2>Add New User</h2>
  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>
  <form method="POST" class="needs-validation mt-4" novalidate>
    <div class="mb-3"><label class="form-label">First Name</label>
      <input type="text" name="first_name" class="form-control" required>
      <div class="invalid-feedback">First name is required.</div>
    </div>
    <div class="mb-3"><label class="form-label">Last Name</label>
      <input type="text" name="last_name" class="form-control" required>
      <div class="invalid-feedback">Last name is required.</div>
    </div>
    <div class="mb-3"><label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
      <div class="invalid-feedback">Valid email is required.</div>
    </div>
    <div class="mb-3"><label class="form-label">Phone (11 digits)</label>
      <input type="text" name="phone" class="form-control" pattern="\d{11}" required>
      <div class="invalid-feedback">Phone must be 11 digits.</div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
    <a href="index.php" class="btn btn-secondary">Back</a>
  </form>
  <script>
    (() => {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>
</body>

</html>