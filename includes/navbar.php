<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <nav class="navbar">
        <div class="logo">Desa Poco Golo Kempo</div>

        <ul class="nav-links" id="navLinks">
            <li><a href="/pocogolo/#home">Beranda</a></li>
            <li><a href="/pocogolo/#about">Tentang</a></li>
            <li><a href="/pocogolo/#gallery">Galeri</a></li>
            <li><a href="/pocogolo/#struktur">Struktur</a></li>
            <li><a href="/pocogolo/#contact-section">Kontak</a></li>

            <!-- DOKUMEN (NO DROPDOWN) -->
            <li>
                <a href="/pocogolo/documents.php">Dokumen</a>
            </li>

            <!-- AUTH SECTION -->
            <?php if (isset($_SESSION['role'])): ?>

            <?php if ($_SESSION['role'] === 'admin'): ?>
            <li>
                <a href="/pocogolo/admin/activity_log.php">Riwayat</a>
            </li>
            <?php endif; ?>

            <li>
                <a href="/pocogolo/auth/logout.php">Logout</a>
            </li>

            <?php else: ?>

            <!-- LOGIN / REGISTER DROPDOWN -->
            <li class="dropdown">
                <a href="#">Akun ▾</a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="drop-a" href="/pocogolo/auth/login.php">
                            Login
                        </a>
                    </li>
                    <li>
                        <a class="drop-a" href="/pocogolo/auth/register.php">
                            Daftar
                        </a>
                    </li>
                </ul>
            </li>

            <?php endif; ?>
        </ul>

        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
</header>