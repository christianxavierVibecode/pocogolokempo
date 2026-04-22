<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <nav class="navbar">
        <div class="logo">Desa Poco Golo Kempo</div>

        <ul class="nav-links" id="navLinks">
            <li><a href="#home">Beranda</a></li>
            <li><a href="#about">Tentang</a></li>
            <li><a href="#gallery">Galeri</a></li>
            <li><a href="#struktur">Struktur</a></li>
            <li><a href="#contact-section">Kontak</a></li>

            <!-- MENU DATABASE -->
            <li>
                <?php if (isset($_SESSION['role'])): ?>
                <a href="documents.php">Database</a>
                <?php else: ?>
                <a href="#" onclick="openLoginModal(); return false;">Database</a>
                <?php endif; ?>
            </li>

            <!-- ADMIN ONLY -->
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <li>
                <a href="admin/activity_log.php">Riwayat</a>
            </li>
            <?php endif; ?>

            <!-- LOGOUT -->
            <?php if (isset($_SESSION['role'])): ?>
            <li>
                <a href="/pocogolo/auth/logout.php">Logout</a>
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