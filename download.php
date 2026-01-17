<?php
session_start();
require __DIR__ . "/config/db.php";

if (!isset($_SESSION['admin'], $_GET['id'])) {
    die("Unauthorized");
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM documents WHERE id = ?");
$stmt->execute([$id]);
$doc = $stmt->fetch();

$filePath = __DIR__ . "/private/uploads/" . $doc['filename'];

header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"" . $doc['filename'] . "\"");
header("Content-Length: " . filesize($filePath));

readfile($filePath);
exit;