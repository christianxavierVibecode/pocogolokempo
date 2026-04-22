<?php
session_start();
require __DIR__ . "/../config/db.php";

/* ADMIN ONLY */
if (
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'admin'
) {
    http_response_code(403);
    exit("Unauthorized");
}

$id = $_GET['id'] ?? null;
if (!$id) {
    exit("Invalid document");
}

/* GET FILE */
$stmt = $pdo->prepare("SELECT filename FROM documents WHERE id = ?");
$stmt->execute([$id]);
$doc = $stmt->fetch();

if (!$doc) {
    exit("Document not found");
}

/* DELETE FILE */
$filePath = __DIR__ . "/../private/uploads/" . $doc['filename'];
if (file_exists($filePath)) {
    unlink($filePath);
}

/* DELETE DB */
$stmt = $pdo->prepare("DELETE FROM documents WHERE id = ?");
$stmt->execute([$id]);

/* REDIRECT */
header("Location: /documents.php");
exit;