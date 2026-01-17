<?php
session_start();

if (!isset($_GET['file'])) {
    http_response_code(404);
    exit;
}

$file = basename($_GET['file']);
$path = __DIR__ . "/private/uploads/" . $file;

if (!file_exists($path)) {
    http_response_code(404);
    exit;
}

header("Content-Type: application/pdf");
header("Content-Disposition: inline");
header("X-Content-Type-Options: nosniff");

readfile($path);
exit;