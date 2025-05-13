 <?php include 'config.php';
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $row = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fn = $_POST['first_name'];
        $ln = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        if (!empty($fn) && !empty($ln) && filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match(
            '/^\d{11}$/',
            $phone
        )) {
            $conn->query("UPDATE users SET first_name='$fn', last_name='$ln', email='$email', phone='$phone' WHERE
 id=$id");
            header("Location: index.php");
        } else {
            $error = "Please fill out the form correctly.";
        }
    }
    ?>

 <!DOCTYPE html>
 <html>

 <head>
     <title>Edit User</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 </head>

 <body class="container mt-5">
     <h2>Edit User</h2>
     <?php if (!empty($error)): ?>
         <div class="alert alert-danger"><?= $error ?></div>
     <?php endif; ?>
     <form method="POST" class="needs-validation mt-4" novalidate>
         <div class="mb-3"><label class="form-label">First Name</label>
             <input type="text" name="first_name" class="form-control" value="<?= $row['first_name'] ?>"
                 required>
             <div class="invalid-feedback">First name is required.</div>
         </div>
         <div class="mb-3"><label class="form-label">Last Name</label>
             <input type="text" name="last_name" class="form-control" value="<?= $row['last_name'] ?>" required>
             <div class="invalid-feedback">Last name is required.</div>
         </div>
         <div class="mb-3"><label class="form-label">Email</label>
             <input type="email" name="email" class="form-control" value="<?= $row['email'] ?>" required>
             <div class="invalid-feedback">Valid email is required.</div>
         </div>
         <div class="mb-3"><label class="form-label">Phone (11 digits)</label>
             <input type="text" name="phone" class="form-control" value="<?= $row['phone'] ?>" pattern="\d{11}"
                 required>
             <div class="invalid-feedback">Phone must be 11 digits.</div>
         </div>
         <button type="submit" class="btn btn-primary">Update</button>
         <a href="index.php" class="btn btn-secondary">Cancel</a>
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