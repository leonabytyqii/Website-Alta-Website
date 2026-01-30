<?php
session_start();
$currentPage = 'experiences.php';
require __DIR__ . "/includes/db.php";

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

$id = (int)($_GET["id"] ?? 0);
$userId = (int)$_SESSION["user_id"];
$error = "";

$stmt = $conn->prepare("SELECT * FROM experiences WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $userId);
$stmt->execute();
$res = $stmt->get_result();
$post = $res->fetch_assoc();
$stmt->close();

if (!$post) {
  echo "Unauthorized or post not found.";
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = trim($_POST["title"] ?? "");
  $description = trim($_POST["description"] ?? "");

  if ($title === "" || $description === "") {
    $error = "All fields are required.";
  } else {
    $stmt = $conn->prepare("UPDATE experiences SET title = ?, description = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssii", $title, $description, $id, $userId);

    if ($stmt->execute()) {
      header("Location: experiences.php?mine=1");
      exit;
    } else {
      $error = "Database error: " . $conn->error;
    }
    $stmt->close();
  }
}

include __DIR__ . "/includes/header.php";
?>

<div class="experiences-container">
  <h1>Edit Experience ✏️</h1>

  <?php if ($error): ?>
    <p class="no-experiences" style="color:red;"><?= $error ?></p>
  <?php endif; ?>

  <form method="POST" class="exp-form">
    <label>Title</label>
    <input type="text" name="title" value="<?= $post["title"] ?>" required>

    <label>Description</label>
    <textarea name="description" required><?= $post["description"] ?></textarea>

    <button type="submit" class="btn-exp">Update</button>
    <a class="btn-exp secondary" href="experiences.php?mine=1">Cancel</a>
  </form>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>
