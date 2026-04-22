<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // SHOW LOGIN FORM
    ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Desa Poco Golo Kempo</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Style utama situs -->
    <link rel="stylesheet" href="../public/css/style.css">
    <!-- Style khusus halaman auth -->
    <link rel="stylesheet" href="../public/css/auth.css">
</head>
<body>

    <!-- Running Light -->
    <div class="running-light"></div>

    <!-- Navbar -->
    <?php require __DIR__ . "/../includes/navbar.php"; ?>

    <!-- Auth Page -->
    <main class="auth-page">

        <!-- Left Panel: Branding -->
        <div class="auth-panel auth-panel--left">
            <div class="auth-brand">
                <div class="auth-logo-wrap">
                    <img src="../public/img/logo.png" alt="Logo Desa" class="auth-logo">
                </div>
                <h1 class="auth-brand-title">Desa <span>Poco Golo</span><br>Kempo</h1>
                <p class="auth-brand-desc">
                    Portal resmi administrasi dan informasi Desa Poco Golo Kempo.
                    Masuk untuk mengakses layanan dan dokumen desa.
                </p>

                <ul class="auth-features">
                    <li><span class="feat-icon">📄</span> Akses arsip dokumen desa</li>
                    <li><span class="feat-icon">📋</span> Pantau informasi terkini</li>
                    <li><span class="feat-icon">🔒</span> Data aman & terenkripsi</li>
                </ul>
            </div>

            <!-- Decorative circles -->
            <div class="auth-deco auth-deco--1"></div>
            <div class="auth-deco auth-deco--2"></div>
        </div>

        <!-- Right Panel: Form -->
        <div class="auth-panel auth-panel--right">
            <div class="auth-form-wrap">

                <div class="auth-form-header">
                    <h2>Selamat Datang 👋</h2>
                    <p>Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <?php if ($error): ?>
                <div class="auth-alert auth-alert--error">
                    <span>⚠️</span> <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="/pocogolo/auth/login-process.php" class="auth-form">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-wrap">
                            <span class="input-icon">👤</span>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                placeholder="Masukkan username Anda"
                                autocomplete="username"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrap">
                            <span class="input-icon">🔑</span>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan password Anda"
                                autocomplete="current-password"
                                required
                            >
                            <button type="button" class="toggle-pw" aria-label="Tampilkan password" onclick="togglePassword('password', this)">
                                👁
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="auth-btn">
                        Masuk <span class="btn-arrow">→</span>
                    </button>

                </form>

                <p class="auth-switch">
                    Belum punya akun?
                    <a href="register.php">Daftar sekarang</a>
                </p>

            </div>
        </div>

    </main>

    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = '🙈';
            } else {
                input.type = 'password';
                btn.textContent = '👁';
            }
        }
    </script>
</body>
</html>
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