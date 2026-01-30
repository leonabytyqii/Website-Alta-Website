<?php
session_start();
require __DIR__ . "/includes/db.php";

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

$id = (int)($_GET["id"] ?? 0);
$userId = (int)$_SESSION["user_id"];

// fshi edhe foton nga serveri
$stmt = $conn->prepare("SELECT image FROM experiences WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $userId);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("DELETE FROM experiences WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $userId);
$stmt->execute();
$stmt->close();

if (!empty($row["image"])) {
  $fsPath = __DIR__ . "/" . $row["image"];
  if (file_exists($fsPath)) {
    @unlink($fsPath);
  }
}

header("Location: experiences.php?mine=1");
exit;
