<?php
session_start();
require __DIR__ . "/includes/db.php";

class ExperienceHandler {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function checkLogin() {
        if (!isset($_SESSION["user_id"])) {
            header("Location: login.php");
            exit;
        }
    }

    public function addExperience($title, $description, $imagePath, $userId) {
        $stmt = $this->conn->prepare(
            "INSERT INTO experiences (title, description, image, user_id) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("sssi", $title, $description, $imagePath, $userId);
        $stmt->execute();
        $stmt->close();
        return true;
    }
}

$handler = new ExperienceHandler($conn);
$handler->checkLogin();

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $userId = $_SESSION["user_id"];

    if ($title === "" || $description === "") {
        $error = "All fields are required.";
    } else {
        $imagePath = null;

        if (!empty($_FILES["image"]["name"])) {

            $allowedTypes = ["jpg","jpeg","png","webp"];
            $fileExt = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

            if (!in_array($fileExt, $allowedTypes)) {
                $error = "Only JPG, PNG, WEBP images allowed.";
            } else {
                $folder = "uploads/";

                if (!is_dir($folder)) {
                    mkdir($folder, 0777, true);
                }

                $imageName = time() . "_" . basename($_FILES["image"]["name"]);
                $imagePath = $folder . $imageName;

                move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
            }
        }

        if ($error === "") {
            if ($handler->addExperience($title, $description, $imagePath, $userId)) {
                $success = "Experience added successfully!";
            } else {
                $error = "Database error.";
            }
        }
    }
}

include __DIR__ . "/includes/header.php";
?>

<h2>Add Your Experience</h2>

<?php if ($error): ?>
<p style="color:red"><?= $error ?></p>
<?php endif; ?>

<?php if ($success): ?>
<p style="color:green"><?= $success ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
<label>Title</label>
<input type="text" name="title" required>

<label>Description</label>
<textarea name="description" required></textarea>

<label>Photo</label>
<input type="file" name="image">

<button type="submit">Submit</button>
</form>

<?php include __DIR__ . "/includes/footer.php"; ?>
