<?php
session_start();
require __DIR__ . "/../config/db.php";
require __DIR__ . "/../includes/auth_admin.php";

$id = intval($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT filename, title FROM documents WHERE id = ?");
$stmt->execute([$id]);
$doc = $stmt->fetch();

if (!$doc) {
    die("File not found");
}

$filePath = __DIR__ . "/../private/uploads/" . $doc['filename'];

if (!file_exists($filePath)) {
    die("File missing");
}

header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"" . basename($doc['title']) . ".pdf\"");
header("Content-Length: " . filesize($filePath));

readfile($filePath);
exit;