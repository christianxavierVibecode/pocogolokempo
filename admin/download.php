<?php
session_start();
require "../config/db.php";
require "../includes/auth_admin.php";

if (!isset($_GET['id'])) {
    die("Invalid document");
}

$docId = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM documents WHERE id = ?");
$stmt->execute([$docId]);
$doc = $stmt->fetch();

if (!$doc) {
    die("Document not found");
}

$filePath = __DIR__ . "/../private/uploads/" . $doc['filename'];

if (!file_exists($filePath)) {
    die("File not found");
}

if (ob_get_length()) {
    ob_end_clean();
}

header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"" . basename($doc['filename']) . "\"");
header("Content-Length: " . filesize($filePath));

readfile($filePath);
exit;