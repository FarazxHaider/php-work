<?php include 'config.php';
 $result = $conn->query("SELECT * FROM users");
 ?>

 <!DOCTYPE html>
 <html>
 <head>
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 </head>
  <body class="container mt-5">
    <h2>User Management</h2>
    <a href="create.php" class="btn btn-success mb-3">Add User</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
         <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['first_name'] ?></td>
                <td><?= $row['last_name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td>
                    <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return
 confirm('Delete this user?')">Delete</a>
 </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
 </body>
 </html>

