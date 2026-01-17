<?php
session_start();
require "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
$stmt->execute([$username]);
$admin = $stmt->fetch();

if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['admin'] = true;
    header("Location: /pocogolo/documents.php");
    exit;
} else {
    echo "Login failed";
}

?>

<link rel="stylesheet" href="/public/css/style.css">