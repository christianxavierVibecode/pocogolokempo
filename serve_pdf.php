<?php
session_start();
require __DIR__ . "/config/db.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    http_response_code(404);
    exit;
}

/* Fetch document */
$stmt = $pdo->prepare("SELECT * FROM documents WHERE id = ?");
$stmt->execute([$id]);
$doc = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$doc) {
    http_response_code(404);
    exit;
}

/* File path */
$filePath = __DIR__ . "/private/uploads/" . $doc['filename'];
if (!file_exists($filePath)) {
    http_response_code(404);
    exit;
}

/* Admin check */
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;

/* Download only allowed for admin */
if (isset($_GET['download']) && !$isAdmin) {
    http_response_code(403);
    exit("Access denied");
}

/* Headers */
header("Content-Type: application/pdf");

if ($isAdmin && isset($_GET['download'])) {
    header('Content-Disposition: attachment; filename="' . basename($doc['filename']) . '"');
} else {
    header("Content-Disposition: inline");
}

/* Prevent caching */
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("X-Content-Type-Options: nosniff");

readfile($filePath);
exit;