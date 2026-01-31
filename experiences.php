<?php
session_start();
$currentPage = 'experiences.php';
require __DIR__ . "/includes/db.php";

$onlyMine = isset($_GET["mine"]) && $_GET["mine"] == "1";
$userId = $_SESSION["user_id"] ?? null;

$sql = "
  SELECT experiences.*, users.username
  FROM experiences
  JOIN users ON experiences.user_id = users.id
";
if ($onlyMine && $userId) {
  $sql .= " WHERE experiences.user_id = " . (int)$userId;
}
$sql .= " ORDER BY experiences.created_at DESC";

$result = $conn->query($sql);

include __DIR__ . "/includes/header.php";
?> 

<div class="experiences-container">
  <div class="exp-topbar">
    <h1>User Experiences <span>🌍</span></h1>
<!-- Experiences btn-->
    <div class="exp-actions">
      <?php if (isset($_SESSION["user_id"])): ?>
        <a class="btn-exp" href="add_experience.php">+ Add Experience</a>
        <a class="btn-exp secondary" href="experiences.php?mine=1">My Experiences</a>
        <a class="btn-exp secondary" href="experiences.php">All</a>
      <?php else: ?>
        <a class="btn-exp" href="login.php">Log in to post</a>
      <?php endif; ?>
    </div>
  </div>

  <?php if (!$result || $result->num_rows === 0): ?>
    <p class="no-experiences">No experiences shared yet.</p>
  <?php else: ?>
    <div class="experiences-grid">
      <?php while ($exp = $result->fetch_assoc()): ?>
        <div class="experience-card">

          <?php if (!empty($exp["image"])): ?>
            <img src="<?= $exp["image"] ?>" alt="Experience image">
          <?php endif; ?>

          <div class="experience-content">
            <h3><?= $exp["title"] ?></h3>
            <p><?= $exp["description"] ?></p>

            <div class="experience-meta">
              <span>👤 <?= $exp["username"] ?></span>
              <span>📅 <?= date("d M Y", strtotime($exp["created_at"])) ?></span>
            </div>

            <?php if (isset($_SESSION["user_id"]) && (int)$_SESSION["user_id"] === (int)$exp["user_id"]): ?>
              <div class="post-actions">
                <a href="edit_experience.php?id=<?= (int)$exp["id"] ?>">Edit</a>
                <a href="delete_experience.php?id=<?= (int)$exp["id"] ?>"
                   onclick="return confirm('Are you sure you want to delete this experience?')">Delete</a>
              </div>
            <?php endif; ?>

          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>
<script src="/website-alta-website-1/javascript/experiences.js"></script>
