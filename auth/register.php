<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — Desa Poco Golo Kempo</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/auth.css">
</head>
<body>

    <div class="running-light"></div>

    <?php require __DIR__ . "/../includes/navbar.php"; ?>

    <main class="auth-page">

        <!-- Left Panel -->
        <div class="auth-panel auth-panel--left">
            <div class="auth-brand">
                <div class="auth-logo-wrap">
                    <img src="../public/img/logo.png" alt="Logo Desa" class="auth-logo">
                </div>
                <h1 class="auth-brand-title">Bergabung<br>Bersama <span>Kami</span></h1>
                <p class="auth-brand-desc">
                    Buat akun untuk mendapatkan akses ke portal layanan
                    dan informasi resmi Desa Poco Golo Kempo.
                </p>

                <ul class="auth-features">
                    <li><span class="feat-icon">✅</span> Proses pendaftaran cepat</li>
                    <li><span class="feat-icon">📲</span> Notifikasi informasi terkini</li>
                    <li><span class="feat-icon">🛡️</span> Data pribadi terlindungi</li>
                </ul>
            </div>

            <div class="auth-deco auth-deco--1"></div>
            <div class="auth-deco auth-deco--2"></div>
        </div>

        <!-- Right Panel: Form -->
        <div class="auth-panel auth-panel--right">
            <div class="auth-form-wrap">

                <div class="auth-form-header">
                    <h2>Buat Akun Baru ✨</h2>
                    <p>Isi data di bawah untuk mendaftar</p>
                </div>

                <?php if ($error): ?>
                <div class="auth-alert auth-alert--error">
                    <span>⚠️</span> <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>

                <?php if ($success): ?>
                <div class="auth-alert auth-alert--success">
                    <span>✅</span> <?= htmlspecialchars($success) ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="/pocogolo/auth/register-process.php" class="auth-form">

                    <div class="form-row-2">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <div class="input-wrap">
                                <span class="input-icon">🪪</span>
                                <input
                                    type="text"
                                    id="nama"
                                    name="nama"
                                    placeholder="Nama lengkap"
                                    required
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-wrap">
                                <span class="input-icon">👤</span>
                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    placeholder="Username unik"
                                    autocomplete="username"
                                    required
                                >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrap">
                            <span class="input-icon">📧</span>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="contoh@email.com"
                                autocomplete="email"
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
                                placeholder="Minimal 8 karakter"
                                autocomplete="new-password"
                                required
                            >
                            <button type="button" class="toggle-pw" onclick="togglePassword('password', this)">👁</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <div class="input-wrap">
                            <span class="input-icon">🔐</span>
                            <input
                                type="password"
                                id="confirm_password"
                                name="confirm_password"
                                placeholder="Ulangi password"
                                autocomplete="new-password"
                                required
                            >
                            <button type="button" class="toggle-pw" onclick="togglePassword('confirm_password', this)">👁</button>
                        </div>
                        <div class="pw-match-msg" id="pwMatch"></div>
                    </div>

                    <!-- Password strength indicator -->
                    <div class="pw-strength-wrap">
                        <div class="pw-strength-bar">
                            <div class="pw-strength-fill" id="pwStrengthFill"></div>
                        </div>
                        <span class="pw-strength-label" id="pwStrengthLabel">Kekuatan password</span>
                    </div>

                    <button type="submit" class="auth-btn">
                        Daftar Sekarang <span class="btn-arrow">→</span>
                    </button>

                </form>

                <p class="auth-switch">
                    Sudah punya akun?
                    <a href="login.php">Masuk di sini</a>
                </p>

            </div>
        </div>

    </main>

    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
            btn.textContent = input.type === 'password' ? '👁' : '🙈';
        }

        // Password match check
        const pw  = document.getElementById('password');
        const cpw = document.getElementById('confirm_password');
        const msg = document.getElementById('pwMatch');

        function checkMatch() {
            if (!cpw.value) { msg.textContent = ''; return; }
            if (pw.value === cpw.value) {
                msg.textContent = '✓ Password cocok';
                msg.className = 'pw-match-msg pw-match--ok';
            } else {
                msg.textContent = '✗ Password tidak cocok';
                msg.className = 'pw-match-msg pw-match--err';
            }
        }

        cpw.addEventListener('input', checkMatch);
        pw.addEventListener('input', () => { checkStrength(); checkMatch(); });

        // Password strength
        const fill  = document.getElementById('pwStrengthFill');
        const label = document.getElementById('pwStrengthLabel');

        function checkStrength() {
            const v = pw.value;
            let score = 0;
            if (v.length >= 8)           score++;
            if (/[A-Z]/.test(v))         score++;
            if (/[0-9]/.test(v))         score++;
            if (/[^A-Za-z0-9]/.test(v))  score++;

            const levels = [
                { pct: '0%',   color: 'transparent', text: 'Kekuatan password' },
                { pct: '25%',  color: '#e53e3e',      text: 'Lemah' },
                { pct: '50%',  color: '#d69e2e',      text: 'Sedang' },
                { pct: '75%',  color: '#3182ce',      text: 'Kuat' },
                { pct: '100%', color: '#276749',      text: 'Sangat Kuat' },
            ];

            fill.style.width          = levels[score].pct;
            fill.style.backgroundColor = levels[score].color;
            label.textContent         = levels[score].text;
            label.style.color         = levels[score].color === 'transparent' ? '#a0aec0' : levels[score].color;
        }
    </script>
</body>
</html>
<?php
    exit;
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $pdo->prepare("
    INSERT INTO users (name, email, password, is_verified, created_at)
    VALUES (?, ?, ?, 1, NOW())
");
$stmt->execute([$name, $email, $password]);

header("Location: /pocogolo/auth/login.php");
exit;