<header>
    <nav class="navbar">
        <div class="logo">Desa Poco Golo Kempo</div>

        <ul class="nav-links" id="navLinks">
            <li><a href="/pocogolo/#home">Beranda</a></li>
            <li><a href="/pocogolo/#about">Tentang</a></li>
            <li><a href="/pocogolo/#gallery">Galeri</a></li>
            <li><a href="/pocogolo/#struktur">Perangkat Desa</a></li>
            <li><a href="/pocogolo/#contact-section">Kontak</a></li>

            <li class="dropdown">
                <a href="#">Regulasi ▾</a>
                <ul class="dropdown-menu">
                    <li><a class="drop-a" href="/pocogolo/documents.php">Arsip Dokumen</a></li>
                    <li><a class="drop-a" href="/pocogolo/perkades.html">Perkades</a></li>
                    <li><a class="drop-a" href="/pocogolo/perdes.html">Perdes</a></li>
                    <li><a class="drop-a" href="/pocogolo/sk-kepala-desa.html">SK Kepala Desa</a></li>
                </ul>
            </li>

            <?php if (isset($_SESSION['admin'])): ?>
            <!-- ADMIN LOGGED IN -->
            <li>
                <a href="/pocogolo/auth/logout.php">Logout</a>
            </li>
            <?php else: ?>
            <!-- PUBLIC USER -->
            <li><a onclick="openLoginModal()">Database</a></li>
            <?php endif; ?>
        </ul>

        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
</header>