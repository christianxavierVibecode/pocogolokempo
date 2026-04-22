<?php
$host = "localhost";
$db   = "pocogolo_desa_db";     // ← change this
$user = "pocogolo_admin";        // ← change this
$pass = "pocogolo2007";   // ← change this

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}