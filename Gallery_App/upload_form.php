<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
include 'includes/header.php';
?>

<div class="container mt-4">
  <h2>Upload Image</h2>
  <form method="POST" action="upload.php" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Image Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Select Image</label>
      <input type="file" name="image" class="form-control" accept="image/*" required>
    </div>
    <button class="btn btn-success">Upload</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>