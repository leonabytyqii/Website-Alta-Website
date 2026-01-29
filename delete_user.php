<?php
session_start();
require __DIR__ . "/includes/db.php";


class DeleteUserHandler {

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

    public function deleteUser() {

        // Kontrollo ID
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: dashboard.php");
            exit;
        }

        $userId = (int) $_GET["id"];

        // Admini s’mund ta fshijë veten
        if ($userId === (int) $_SESSION["user_id"]) {
            header("Location: dashboard.php?error=selfdelete");
            exit;
        }

        // Kontrollo rolin e user-it
        $stmt = $this->conn->prepare(
            "SELECT role FROM users WHERE id = ?"
        );

        if (!$stmt) {
            header("Location: dashboard.php");
            exit;
        }

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Mos lejo fshirjen e admin-it tjetër
        if ($user && $user["role"] === "admin") {
            header("Location: dashboard.php?error=admin_protected");
            exit;
        }

        // Fshij user-in
        $stmt = $this->conn->prepare(
            "DELETE FROM users WHERE id = ?"
        );

        if (!$stmt) {
            header("Location: dashboard.php");
            exit;
        }

        $stmt->bind_param("i", $userId);
        $stmt->execute();

        header("Location: dashboard.php");
        exit;
    }
}


$deleteUser = new DeleteUserHandler($conn);
$deleteUser->checkAdmin();
$deleteUser->deleteUser();

