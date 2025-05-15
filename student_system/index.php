<?php
include('includes/db.php');
session_start();

if (!isset($_SESSION['user'])) {
  $_SESSION['error'] = "Please login to continue.";
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Student Records</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">
</head>

<body class="p-4">
  <div class="container">
    <h3>Welcome, <?= $_SESSION['user']['username'] ?> (<?= $_SESSION['user']['role'] ?>)</h3>
    <a href="logout.php" class="btn btn-danger float-end">Logout</a>

    <!-- Success Message -->
    <?php if (isset($_SESSION['message'])): ?>
      <div class="alert alert-success alert-dismissible fade show mt-2">
        <?= $_SESSION['message'];
        unset($_SESSION['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <!-- Search -->
    <form method="GET" class="my-3">
      <input type="text" name="search" value="<?= $_GET['search'] ?? '' ?>" class="form-control"
        placeholder="Search by name, roll, or class">
    </form>

    <!-- Add Student Button -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">+
      Add Student</button>

    <!-- Student Table -->
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>

          <th>#</th>
          <th>Name</th>
          <th>Roll</th>
          <th>Class</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Act
            ions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $search = $_GET['search'] ?? '';
        $limit = 5;
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * $limit;

        $searchSql = "WHERE name LIKE '%$search%' OR roll_number LIKE '%$search%' OR class 
LIKE '%$search%'";
        $query = mysqli_query($conn, "SELECT * FROM students $searchSql LIMIT $offset, $limit");

        if (mysqli_num_rows($query) > 0):
          $sn = $offset + 1;
          while ($row = mysqli_fetch_assoc($query)):
        ?>
            <tr>
              <td><?= $sn++ ?></td>
              <td><?= $row['name'] ?></td>
              <td><?= $row['roll_number'] ?></td>
              <td><?= $row['class'] ?></td>
              <td><?= $row['email'] ?></td>
              <td><?= $row['contact'] ?></td>
              <td>
                <a href="update_student.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete_student.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this student?')" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
          <?php endwhile;
        else: ?>
          <tr>
            <td colspan="7">No records found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <!-- Pagination -->
    <?php
    $totalRes = mysqli_query($conn, "SELECT COUNT(*) as total FROM students $searchSql");
    $total = mysqli_fetch_assoc($totalRes)['total'];
    $pages = ceil($total / $limit);
    ?>
    <nav>
      <ul class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
          <li class="page-item <?= $i == $page ? 'active' : '' ?>">
            <a class="page-link" href="?search=<?= $search ?>&page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>
      </ul>
    </nav>
  </div>

  <!-- Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
      <form method="POST" action="add_student.php" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Student</h5>
        </div>
        <div class="modal-body">
          <input name="name" class="form-control mb-2" placeholder="Name" required>
          <input name="roll_number" class="form-control mb-2" placeholder="Roll Number" required>
          <input name="class" class="form-control mb-2" placeholder="Class">
          <input name="email" class="form-control mb-2" placeholder="Email">
          <input name="contact" class="form-control mb-2" placeholder="Contact">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>