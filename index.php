<?php session_start(); ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perangkat Desa Poco Golo Kempo</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Star Particle Canvas -->
    <canvas id="stars-canvas"></canvas>

    <!-- Running Light Effect (Cahaya Berjalan) -->
    <div class="running-light"></div>

    <!-- Splash Screen with Kabupaten Logo -->
    <div class="splash" id="splash">
        <img src="https://upload.wikimedia.org/wikipedia/commons/f/ff/Lambang_Kabupaten_Manggarai_Barat.png"
            alt="Logo Kabupaten Manggarai Barat" />
    </div>

    <?php require "includes/navbar.php"; ?>

    <section id="home" class="hero hero-modern">
        <div class="hero-container">
            <div class="hero-left">
                <span class="hero-badge">Desa Poco Golo Kempo</span>
                <h1>
                    Melayani Masyarakat <br />
                    dengan <span>Transparansi & Dedikasi</span>
                </h1>
                <p>Pusat informasi resmi Perangkat Desa Poco Golo Kempo. Mendukung pelayanan publik yang cepat, terbuka,
                    dan terpercaya.</p>

                <div class="hero-actions">
                    <a href="#about" class="btn-primary">Pelajari Lebih Lanjut</a>
                    <a href="#struktur" class="btn-secondary">Lihat Perangkat Desa</a>
                </div>
            </div>

            <div class="hero-right">
                <div class="image-stack">
                    <img src="./public/images/poco-3.jpeg" />
                    <img src="./public/images/poco-1.jpeg" />
                    <img src="./public/images/poco-2.jpeg" />
                </div>
            </div>
        </div>
    </section>

    <section id="about">
        <span class="about-label">Tentang Kami</span>

        <h2 class="about-title">
            Melayani Masyarakat<br />
            dengan Komitmen & Transparansi
        </h2>

        <p class="about-desc">Website resmi Desa Poco Golo Kempo sebagai pusat informasi, pelayanan, dan komunikasi
            antara pemerintah desa dan masyarakat. Kami terletak di Kecamatan Sano Nggoang, Kabupaten Manggarai Barat,
            86757.</p>

        <div class="about-arc">
            <img src="./public/images/about-1.jpeg" alt="" />
            <img src="./public/images/about-2.jpeg" alt="" />
            <img src="./public/images/about-3.jpeg" alt="" />
            <img src="./public/images/about-4.jpeg" alt="" />
            <img src="./public/images/about-5.jpeg" alt="" />
        </div>

        <div class="about-points">
            <div>
                <h4>Pelayanan Publik</h4>
                <p>Cepat, tepat, dan mudah diakses oleh masyarakat.</p>
            </div>
            <div>
                <h4>Transparansi</h4>
                <p>Informasi desa disampaikan secara terbuka dan akurat.</p>
            </div>
            <div>
                <h4>Partisipatif</h4>
                <p>Mendorong peran aktif masyarakat dalam pembangunan desa.</p>
            </div>
        </div>
    </section>

    <section id="gallery">
        <h2 class="gallery-title">Galeri Kegiatan Desa</h2>
        <p class="gallery-desc">Dokumentasi kegiatan dan aktivitas Desa Poco Golo Kempo</p>

        <div class="carousel-wrapper">
            <button class="nav prev" onclick="scrollGallery(-1)">‹</button>

            <div class="carousel" id="carousel">
                <div class="carousel-item">
                    <img src="./public/images/gallery-1.jpg" alt="Musyawarah Desa" />
                    <div class="overlay">
                        <h4>Pembangunan Desa</h4>
                        <p>Proses pembangunan infrastruktur</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="./public/images/gallery-2.jpg" alt="Gotong Royong" />
                    <div class="overlay">
                        <h4>Pembangunan Desa</h4>
                        <p>Proses pembangunan infrastruktur</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="./public/images/gallery-3.jpg" alt="Pelayanan Administrasi" />
                    <div class="overlay">
                        <h4>Pembangunan Desa</h4>
                        <p>Proses pembangunan infrastruktur</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="./public/images/gallery-4.jpg" alt="Kegiatan Sosial" />
                    <div class="overlay">
                        <h4>Pembangunan Desa</h4>
                        <p>Proses pembangunan infrastruktur</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="./public/images/gallery-5.jpeg" alt="Pembangunan Desa" />
                    <div class="overlay">
                        <h4>Rapat Desa</h4>
                        <p>Rapat perencanaan pembangunan desa</p>
                    </div>
                </div>
            </div>

            <button class="nav next" onclick="scrollGallery(1)">›</button>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="modal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-content">
            <img id="modalImg" src="" alt="Gambar Besar" />
            <div id="caption"
                style="position: absolute; bottom: 20px; left: 20px; color: white; font-size: 1.2rem; background: rgba(0, 0, 0, 0.5); padding: 10px; border-radius: 5px">
            </div>
        </div>
    </div>
    <!-- Login Modal (New Integration) -->
    <div id="loginModal" class="modal">
        <span class="close" onclick="closeLoginModal()" style="top: 10px; right: 20px; font-size: 30px">&times;</span>
        <div id="loginLoader">
            <div class="login-spinner"></div>
        </div>
        <div id="loginContainer" class="login-container">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/ff/Lambang_Kabupaten_Manggarai_Barat.png"
                alt="Logo Kabupaten Manggarai Barat" class="login-logo" />
            <h1 class="login-h1">Sistem Database<br />Perangkat Desa Poco Golo Kempo</h1>
            <form class="login-form" id="loginForm" action="auth/login.php" method="post">
                <label class="login-label" for="username">Username:</label>
                <input class="login-input" type="text" id="username" name="username" required />

                <label class="login-label" for="password">Password:</label>
                <input class="login-input" type="password" id="password" name="password" required />

                <button class="login-button" type="submit">Masuk</button>
            </form>
            <p style="margin-top: 20px; font-size: 12px; color: #888">&copy; 2025 Perangkat Desa Poco Golo Kempo</p>
        </div>
    </div>

    <section id="struktur">
        <h2 class="struktur-title">Struktur Perangkat Desa</h2>

        <!-- Kepala Desa -->
        <div class="leader">
            <h3>Kepala Desa</h3>
            <p>Kornelis De Mose</p>
        </div>

        <!-- Sekretaris -->
        <div class="leader secondary">
            <h3>Sekretaris Desa</h3>
            <p>Rofinus Subandri</p>
        </div>

        <div class="divider"></div>

        <!-- KAUR -->
        <div class="grid">
            <div class="card">
                <h4>Kaur Keuangan</h4>
                <span>Maria Sulastri Sartika, S.E</span>
            </div>
            <div class="card">
                <h4>Kaur Perencanaan</h4>
                <span>Arkadius Seradib, S.T</span>
            </div>
            <div class="card">
                <h4>Kaur TU dan Umum</h4>
                <span>Biaksi, S.Si</span>
            </div>
        </div>

        <div class="divider"></div>

        <!-- KASI -->
        <div class="grid">
            <div class="card">
                <h4>Kasi Pelayanan</h4>
                <span>Amir Safrudin, S.Pd</span>
            </div>
            <div class="card">
                <h4>Kasi Pemerintahan</h4>
                <span>Mariana Murni</span>
            </div>
            <div class="card">
                <h4>Kasi Kesejahteraan</h4>
                <span>Siti Fadila</span>
            </div>
        </div>

        <div class="divider"></div>

        <!-- KEPALA DUSUN -->
        <div class="grid small">
            <div class="card">
                <h4>Kadus Rambang I</h4>
                <span>Yoseph Toft</span>
            </div>
            <div class="card">
                <h4>Kadus Rambang II</h4>
                <span>Oswaldus H. Manjelo</span>
            </div>
            <div class="card">
                <h4>Kadus Compang I</h4>
                <span>Fitri Ana</span>
            </div>
            <div class="card">
                <h4>Kadus Compang II</h4>
                <span>Heronymus K. Hansmu</span>
            </div>
        </div>
    </section>

    <section id="contact-section">
        <h2 class="contact-title">Hubungi Kami</h2>
        <p class="contact-desc">Hubungi kami jika anda memiliki pertanyaan atau keluhan</p>

        <!-- TOP INFO CARDS -->
        <div class="contact-cards">
            <div class="contact-card">
                <span class="icon">📍</span>
                <h4>Alamat</h4>
                <p>Desa Poco Golo Kempo Kec. Sano Nggoang Kab. Manggarai Barat, NTT 86757</p>
            </div>

            <div class="contact-card">
                <span class="icon">📞</span>
                <h4>Telepon</h4>
                <p>(+62) 812-3456-7890</p>
            </div>

            <div class="contact-card">
                <span class="icon">✉️</span>
                <h4>Email</h4>
                <p>pocogolokempo@desa.go.id</p>
            </div>
        </div>

        <!-- MAIN CONTACT AREA -->
        <div class="contact-main">
            <!-- FORM -->
            <div class="contact-form">
                <h3>Hubungi Kami</h3>
                <p class="form-desc">Untuk pertanyaan dan keperluan layanan desa</p>

                <form>
                    <!-- EMAIL -->
                    <label>Email</label>
                    <input type="email" placeholder="example@email.com" required />

                    <!-- PHONE -->
                    <label>Nomor Telepon</label>
                    <input type="tel" placeholder="Nomer Telepon" />

                    <!-- NAME ROW -->
                    <div class="form-row">
                        <div>
                            <label>Nama Depan</label>
                            <input type="text" placeholder="Nama depan" required />
                        </div>
                        <div>
                            <label>Nama Belakang</label>
                            <input type="text" placeholder="Nama belakang" />
                        </div>
                    </div>

                    <!-- SUBJECT -->
                    <label>Judul</label>
                    <input type="text" placeholder="Judul pesan" />

                    <!-- MESSAGE -->
                    <label>Pesan</label>
                    <textarea placeholder="Tulis pesan Anda..."></textarea>

                    <button type="submit">Kirim Pesan</button>
                </form>
            </div>

            <!-- MAP / VISUAL -->
            <div class="contact-map">
                <iframe src="https://www.google.com/maps?q=Kantor%20Desa%20Poco%20Golo%20Kempo&output=embed"
                    loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 Perangkat Desa Poco Golo Kempo. Semua hak dilindungi.</p>
        </div>
    </footer>
    <script>
    // Star Particle Effect
    function initStars() {
        const canvas = document.getElementById("stars-canvas");
        if (!canvas) return;

        const ctx = canvas.getContext("2d");
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        let particles = [];
        const numParticles = 100;

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 2 + 1;
                this.speedX = Math.random() * 0.5 - 0.25;
                this.speedY = Math.random() * 0.5 - 0.25;
                this.opacity = Math.random() * 0.5 + 0.5;
            }

            update() {
                this.x += this.speedX;
                this.y += this.speedY;

                if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;

                this.opacity = Math.random() * 0.5 + 0.5;
            }

            draw() {
                ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        particles = Array.from({
            length: numParticles
        }, () => new Particle());

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach((p) => {
                p.update();
                p.draw();
            });
            requestAnimationFrame(animate);
        }

        animate();

        window.addEventListener("resize", () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
    }

    // Splash Screen Hide after 3 seconds
    window.addEventListener("load", () => {
        setTimeout(() => {
            const splash = document.getElementById("splash");
            if (splash) splash.classList.add("hidden");
        }, 3000);
    });

    // Hamburger Menu Toggle
    const hamburger = document.getElementById("hamburger");
    const navLinks = document.getElementById("navLinks");
    hamburger.addEventListener("click", () => {
        navLinks.classList.toggle("active");
    });
    // Close menu on link click
    document.querySelectorAll(".nav-links a").forEach((link) => {
        link.addEventListener("click", () => {
            navLinks.classList.remove("active");
        });
    });
    // Smooth scrolling for nav links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute("href")).scrollIntoView({
                behavior: "smooth",
            });
        });
    });
    // Gallery Modal Functions
    function openModal(src, caption) {
        const modal = document.getElementById("modal");
        const modalImg = document.getElementById("modalImg");
        const captionText = document.getElementById("caption");
        modal.style.display = "flex";
        modalImg.src = src;
        captionText.textContent = caption;
    }

    function closeModal() {
        document.getElementById("modal").style.display = "none";
    }
    // Close modal on outside click
    window.onclick = function(event) {
        const modal = document.getElementById("modal");
        const loginModal = document.getElementById("loginModal");
        if (event.target == modal) {
            closeModal();
        }
        if (event.target == loginModal) {
            closeLoginModal();
        }
    };
    // Login Modal Functions (Integrated)
    function openLoginModal() {
        const loginModal = document.getElementById("loginModal");
        const loginLoader = document.getElementById("loginLoader");
        const loginContainer = document.getElementById("loginContainer");
        loginModal.style.display = "flex";
        loginLoader.style.opacity = "1";
        setTimeout(() => {
            loginLoader.style.opacity = "0";
            setTimeout(() => {
                loginLoader.style.display = "none";
                loginContainer.classList.add("show");
            }, 500);
        }, 1000); // Loading 1 detik
    }

    function closeLoginModal() {
        const loginModal = document.getElementById("loginModal");
        const loginContainer = document.getElementById("loginContainer");
        loginContainer.classList.remove("show");
        setTimeout(() => {
            loginModal.style.display = "none";
        }, 500);
    }
    // Handle form submit (simulasi untuk testing; ganti dengan backend)
    document.addEventListener("DOMContentLoaded", function() {
        initStars(); // Inisialisasi efek partikel bintang
        const loginForm = document.getElementById("loginForm");
        if (loginForm) {
            loginForm.addEventListener("submit", function(e) {
                // Uncomment untuk backend: e.preventDefault(); lalu fetch
                // Untuk testing, biarkan submit normal ke login.php
            });
        }
    });
    // Fade-in animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
            }
        });
    }, observerOptions);
    document.querySelectorAll(".fade-in").forEach((el) => {
        observer.observe(el);
    });
    // Gallery
    function scrollGallery(direction) {
        const carousel = document.getElementById("carousel");
        const scrollAmount = 350;
        carousel.scrollBy({
            left: direction * scrollAmount,
            behavior: "smooth",
        });
    }
    </script>
</body>

</html>