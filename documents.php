<?php
session_start();

require __DIR__ . "/config/db.php";
require __DIR__ . "/includes/auth_user.php"; // user must be logged in + verified

/* ===============================
   HANDLE ADMIN UPLOAD
================================ */
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_SESSION['admin'])
) {
    if (!isset($_FILES['file'], $_POST['title'])) {
        die("Invalid upload");
    }

    $title = trim($_POST['title']);
    $original = basename($_FILES['file']['name']);
    $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));

    if ($ext !== 'pdf') {
        die("Only PDF files are allowed");
    }

    $filename = uniqid() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "", $original);
    $uploadDir = __DIR__ . "/private/uploads/";
    $path = $uploadDir . $filename;

    if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
        die("Upload directory error");
    }

    if (!move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
        die("File upload failed");
    }

    $stmt = $pdo->prepare(
        "INSERT INTO documents (title, filename) VALUES (?, ?)"
    );
    $stmt->execute([$title, $filename]);

    header("Location: documents.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document Archives</title>

    <link rel="stylesheet" href="/pocogolo/public/css/documents.css">
    <link rel="stylesheet" href="/pocogolo/public/css/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>

    <?php require __DIR__ . "/includes/navbar.php"; ?>

    <main class="container">

        <div class="page-header">
            <h1>Dokumen <span>Desa Poco Golo Kempo</span></h1>
            <p class="page-subtitle">
                Dokumen hanya dapat diakses oleh pengguna terverifikasi
            </p>
        </div>

        <!-- ===============================
     ADMIN UPLOAD
    ================================ -->
        <?php if (isset($_SESSION['admin'])): ?>
        <section class="admin-upload" id="uploadPanel">
            <h2>Upload Dokumen</h2>

            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Judul Dokumen" required>
                <input type="file" name="file" accept="application/pdf" required>
                <button type="submit">Upload</button>
            </form>
        </section>
        <?php endif; ?>

        <!-- ===============================
     DOCUMENT LIST
    ================================ -->
        <section class="documents-section">

            <div class="documents-header">
                <h2>List Dokumen</h2>

                <?php if (isset($_SESSION['admin'])): ?>
                <button class="add-btn"
                    onclick="document.getElementById('uploadPanel').scrollIntoView({behavior:'smooth'})">
                    + Tambah Dokumen
                </button>
                <?php endif; ?>
            </div>

            <div class="documents-table">
                <div class="table-head">
                    <span>Nama</span>
                    <span>Format</span>
                    <span>Tanggal</span>
                    <span>Aksi</span>
                </div>

                <?php
            $stmt = $pdo->query("SELECT * FROM documents ORDER BY uploaded_at DESC");
            while ($doc = $stmt->fetch()):
            ?>
                <div class="table-row">
                    <!-- NAME -->
                    <div class="doc-name">
                        <div class="doc-icon">📄</div>
                        <div>
                            <div class="doc-title"><?= htmlspecialchars($doc['title']) ?></div>
                            <div class="doc-sub">PDF file</div>
                        </div>
                    </div>

                    <!-- FORMAT -->
                    <span>PDF</span>

                    <!-- DATE -->
                    <span><?= date("d M Y", strtotime($doc['uploaded_at'])) ?></span>

                    <!-- ACTIONS -->
                    <div class="doc-actions">
                        <!-- VIEW (ALL USERS) -->
                        <a href="view.php?id=<?= $doc['id'] ?>" target="_blank" class="btn-view">
                            View
                        </a>

                        <!-- ADMIN ONLY -->
                        <?php if (isset($_SESSION['admin'])): ?>
                        <a href="/pocogolo/admin/download.php?id=<?= $doc['id'] ?>" class="btn-view">
                            Download
                        </a>
                        <a href="/pocogolo/admin/delete.php?id=<?= $doc['id'] ?>" class="btn-delete"
                            onclick="return confirm('Delete this document?')">
                            Hapus
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>

        </section>

    </main>

</body>

</html>