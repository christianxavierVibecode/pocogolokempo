<?php
session_start();
require "config/db.php";

if (!isset($_SESSION['admin'])) {
    http_response_code(403);
    exit("Access denied");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT filename FROM documents WHERE id=?");
$stmt->execute([$id]);
$file = $stmt->fetch();

if ($file) {
    unlink(__DIR__ . "/private/uploads/" . $file['filename']);
    $pdo->prepare("DELETE FROM documents WHERE id=?")->execute([$id]);
}

header("Location: documents.php");
exit;