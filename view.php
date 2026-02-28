<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . "/config/db.php";

/* ===============================
   MUST BE LOGGED IN
================================ */
if (!isset($_SESSION['role'])) {
    die("Unauthorized");
}

if (!isset($_GET['id'])) {
    die("Missing document ID");
}

$docId = (int) $_GET['id'];

/* ===============================
   GET DOCUMENT
================================ */
$stmt = $pdo->prepare("SELECT * FROM documents WHERE id = ?");
$stmt->execute([$docId]);
$doc = $stmt->fetch();

if (!$doc) {
    die("Document not found");
}

/* ===============================
   LOG USER VIEW (ONLY USERS)
================================ */
if ($_SESSION['role'] === 'user' && isset($_SESSION['user_id'])) {

    $stmt = $pdo->prepare("
        INSERT INTO document_views (user_id, document_id, viewed_at)
        VALUES (?, ?, NOW())
    ");
    $stmt->execute([$_SESSION['user_id'], $docId]);
}

/* ===============================
   SERVE FILE
================================ */
$filePath = __DIR__ . "/private/uploads/" . $doc['filename'];

if (!file_exists($filePath)) {
    die("File not found");
}

header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=\"" . basename($doc['filename']) . "\"");
readfile($filePath);
exit;