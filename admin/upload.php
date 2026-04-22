<?php
session_start();
require __DIR__ . "/../config/db.php";
require __DIR__ . "/../includes/auth_admin.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /pocogolo/documents.php");
    exit;
}

$title = trim($_POST['title'] ?? '');

if (!$title || !isset($_FILES['file'])) {
    die("Invalid upload");
}

$original = $_FILES['file']['name'];
$ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));

if ($ext !== 'pdf') {
    die("Only PDF files allowed");
}

$filename = uniqid() . "_" . preg_replace("/[^a-zA-Z0-9_.-]/", "", $original);
$uploadDir = __DIR__ . "/../private/uploads/";
$path = $uploadDir . $filename;

if (!is_writable($uploadDir)) {
    die("Upload directory not writable");
}

if (!move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
    die("Upload failed");
}

$stmt = $pdo->prepare(
    "INSERT INTO documents (title, filename) VALUES (?, ?)"
);
$stmt->execute([$title, $fi]);