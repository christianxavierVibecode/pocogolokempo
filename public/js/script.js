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

  particles = Array.from(
    {
      length: numParticles,
    },
    () => new Particle()
  );

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
// Close menu on link click — kecuali tombol dropdown (Akun ▾)
document.querySelectorAll(".nav-links a").forEach((link) => {
  link.addEventListener("click", (e) => {
    // Jika link ini adalah toggle dropdown, jangan tutup navbar
    const parentLi = link.closest("li");
    if (parentLi && parentLi.classList.contains("dropdown")) {
      // Toggle sub-menu dropdown di mobile/tablet
      const dropdownMenu = parentLi.querySelector(".dropdown-menu");
      if (dropdownMenu && window.innerWidth <= 1024) {
        e.preventDefault();
        const isVisible = dropdownMenu.style.display === "block";
        dropdownMenu.style.display = isVisible ? "none" : "block";
      }
      return; // Jangan tutup navbar
    }

    // Semua link lain → tutup navbar
    navLinks.classList.remove("active");
  });
});
// Smooth scrolling for nav links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
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
window.onclick = function (event) {
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
document.addEventListener("DOMContentLoaded", function () {
  initStars(); // Inisialisasi efek partikel bintang
  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
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
