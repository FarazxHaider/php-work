<?php
include 'config.php';

$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'latest';
$page = max(1, intval($_GET['page'] ?? 1));
$per_page = 6;
$offset = ($page - 1) * $per_page;
$where = $search ? "WHERE images.title LIKE '%$search%' OR users.username LIKE '%$search%'" : "";
$order_by = match ($sort) {
  'oldest' => 'images.uploaded_at ASC',
  'title_asc' => 'images.title ASC',
  'title_desc' => 'images.title DESC',
  default => 'images.uploaded_at DESC',
};
$total_result = $conn->query("SELECT COUNT(*) as total FROM images JOIN users ON images.user_id = 
users.id $where");
$total = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total / $per_page);
$result = $conn->query("SELECT images.*, users.username FROM images JOIN users ON images.user_id 
= users.id $where ORDER BY $order_by LIMIT $per_page OFFSET $offset");
$users_images = $conn->query("SELECT users.username, COUNT(images.id) as count FROM images 
JOIN users ON images.user_id = users.id GROUP BY users.username");
include 'includes/header.php';
?>
<div class="container mt-4">
  <form method="GET" class="row mb-3">
    <div class="col-md-4"><input name="search" value="<?= htmlspecialchars($search) ?>" class="form
control" placeholder="Search by title or user"></div>
    <div class="col-md-3">
      <select name="sort" class="form-select">
        <option value="latest" <?= $sort == 'latest' ? 'selected' : '' ?>>Latest</option>
        <option value="oldest" <?= $sort == 'oldest' ? 'selected' : '' ?>>Oldest</option>
        <option value="title_asc" <?= $sort == 'title_asc' ? 'selected' : '' ?>>Title A-Z</option>
        <option value="title_desc" <?= $sort == 'title_desc' ? 'selected' : '' ?>>Title Z-A</option>
      </select>
    </div>
    <div class="col-md-2"><button class="btn btn-primary w-100">Filter</button></div>
  </form>
  <div class="row">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="col-md-4 mb-3">
        <div class="card shadow">
          <img src="uploads/<?= $row['filename'] ?>" class="card-img-top" data-bs-toggle="modal" data-bs
            target="#imgModal<?= $row['id'] ?>" style="cursor:pointer;">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
            <p class="card-text small"><?= htmlspecialchars($row['description']) ?></p>
            <p class="text-muted small mb-1">Uploaded by: <?= htmlspecialchars($row['username']) ?></p>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id']): ?>
              <form method="POST" action="delete.php" onsubmit="return confirm('Delete this image?');">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="hidden" name="filename" value="<?= $row['filename'] ?>">
                <button class="btn btn-sm btn-danger">Delete</button>
              </form>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="imgModal<?= $row['id'] ?>" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <img src="uploads/<?= $row['filename'] ?>" class="w-100">
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <!-- Pagination -->
  <nav>
    <ul class="pagination">
      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
          <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&sort=<?= $sort
                                                                                            ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>

  <!-- Image Count -->
  <h5 class="mt-4">Total Images Per User:</h5>
  <ul>
    <?php while ($u = $users_images->fetch_assoc()): ?>
      <li><?= htmlspecialchars($u['username']) ?>: <?= $u['count'] ?> images</li>
    <?php endwhile; ?>
  </ul>
</div>
<?php include 'includes/footer.php'; ?>