<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . "/config/db.php";

/* ===============================
   REQUIRE LOGIN (ADMIN OR USER)
================================ */
if (!isset($_SESSION['role'])) {
    header("Location: /pocogolo/auth/login.php");
    exit;
}

$isAdmin = ($_SESSION['role'] === 'admin');

/* ===============================
   HANDLE ADMIN UPLOAD
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isAdmin) {

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

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
        die("File upload failed");
    }

    $stmt = $pdo->prepare(
        "INSERT INTO documents (title, filename, uploaded_at) VALUES (?, ?, NOW())"
    );
    $stmt->execute([$title, $filename]);

    header("Location: documents.php");
    exit;
}

/* ===============================
   FETCH DOCUMENTS
================================ */
$stmt = $pdo->query("SELECT * FROM documents ORDER BY uploaded_at DESC");
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document Archives</title>

    <link rel="stylesheet" href="./public/css/documents.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
        <?php if ($isAdmin): ?>
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

                <?php if ($isAdmin): ?>
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

                <?php foreach ($documents as $doc): ?>
                <div class="table-row">

                    <div class="doc-name">
                        <div class="doc-icon">📄</div>
                        <div>
                            <div class="doc-title"><?= htmlspecialchars($doc['title']) ?></div>
                            <div class="doc-sub">PDF file</div>
                        </div>
                    </div>

                    <span>PDF</span>
                    <span><?= date("d M Y", strtotime($doc['uploaded_at'])) ?></span>

                    <div class="doc-actions">
                        <a href="view.php?id=<?= $doc['id'] ?>" target="_blank" class="btn-view">
                            View
                        </a>

                        <?php if ($isAdmin): ?>
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
                <?php endforeach; ?>

            </div>

        </section>

    </main>
    <script src="./public/js/script.js"></script>
</body>

</html>