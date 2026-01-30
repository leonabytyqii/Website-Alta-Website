<?php
session_start();
require __DIR__ . "/includes/db.php";

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

$error = "";
// Postimi i nje experience 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = trim($_POST["title"] ?? "");
  $description = trim($_POST["description"] ?? "");
  $userId = (int)$_SESSION["user_id"];

  if ($title === "" || $description === "") {
    $error = "All fields are required.";
  } else {
    $imagePath = null;

    if (!empty($_FILES["image"]["name"])) {
      $allowed = ["jpg","jpeg","png","webp"];
      $ext = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

      if (!in_array($ext, $allowed)) {
        $error = "Only JPG, JPEG, PNG, WEBP images allowed.";
      } else {
        $folderFs = __DIR__ . "/uploads/";

        if (!is_dir($folderFs)) {
          mkdir($folderFs, 0777, true);
        }

        $safeName = preg_replace("/[^a-zA-Z0-9_\-\.]/", "_", basename($_FILES["image"]["name"]));
        $newName = time() . "_" . $safeName;

        $targetFsPath = $folderFs . $newName;
        $imagePath = "uploads/" . $newName;

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFsPath)) {
          $error = "Upload failed. Check folder permissions.";
        }
      }
    }

    if ($error === "") {
      $stmt = $conn->prepare("INSERT INTO experiences (title, description, image, user_id) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("sssi", $title, $description, $imagePath, $userId);

      if ($stmt->execute()) {
        header("Location: experiences.php");
        exit;
      } else {
        $error = "Database error: " . $conn->error;
      }

      $stmt->close();
    }
  }
}

$currentPage = 'add_experience.php';
include __DIR__ . "/includes/header.php";
?>

    <link rel="stylesheet" href="CSS/experiences.css">
<div class="experiences-container">
  <h1>Add Your Experience ✍️</h1>

  <?php if ($error): ?>
    <p class="no-experiences" style="color:red;"><?= $error ?></p>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data" class="exp-form">

    <label>Title</label>
    <input type="text" name="title" placeholder="Enter title..." required>

    <label>Description</label>
    <textarea name="description" placeholder="Share your experience..." required></textarea>

    <label>Photo (optional)</label>
    <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">

    <div class="exp-buttons">
      <button type="submit" class="btn-exp">Post Experience</button>
      <a href="experiences.php" class="btn-exp secondary">Cancel</a>
    </div>

  </form>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>
