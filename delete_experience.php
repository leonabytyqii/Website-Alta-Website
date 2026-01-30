<?php
session_start();
require __DIR__ . "/includes/db.php";

class ExperienceManager {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function checkAdmin() {
        if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
            header("Location: index.php");
            exit;
        }
    }

    public function deleteExperience($id) {
        $stmt = $this->conn->prepare("DELETE FROM experiences WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }
}

$manager = new ExperienceManager($conn);
$manager->checkAdmin();

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET["id"];
$manager->deleteExperience($id);

header("Location: dashboard.php");
exit;
?>
