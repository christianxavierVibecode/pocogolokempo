<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // SHOW LOGIN FORM
    ?>
<form method="POST">
    <h2>Login</h2>
    <input type="text" name="username" placeholder="Username / Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<?php
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (!$username || !$password) {
    die("Missing credentials");
}

/* ================= ADMIN LOGIN ================= */
$stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
$stmt->execute([$username]);
$admin = $stmt->fetch();

if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['role'] = 'admin';
    $_SESSION['admin_id'] = $admin['id'];

    header("Location: /pocogolo/documents.php");
    exit;
}

/* ================= USER LOGIN ================= */
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND is_verified = 1");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['role'] = 'user';
    $_SESSION['user_id'] = $user['id'];

    header("Location: /pocogolo/documents.php");
    exit;
}

die("Invalid username or password");