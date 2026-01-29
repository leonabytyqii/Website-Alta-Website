<?php
session_start();
require __DIR__ . "/includes/db.php";


class DeleteMessageHandler {

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

    public function deleteMessage() {

        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: dashboard.php");
            exit;
        }

        $id = (int) $_GET["id"];

        $stmt = $this->conn->prepare(
            "DELETE FROM contact_messages WHERE id = ?"
        );

        if (!$stmt) {
            header("Location: dashboard.php");
            exit;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: dashboard.php");
        exit;
    }
}


$deleteMessage = new DeleteMessageHandler($conn);
$deleteMessage->checkAdmin();
$deleteMessage->deleteMessage();

