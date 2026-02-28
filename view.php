<?php
session_start();

require __DIR__ . "/../config/db.php";
require __DIR__ . "/../includes/auth_admin.php"; // admin only

$stmt = $pdo->query("
    SELECT users.email, documents.title, document_views.viewed_at
    FROM document_views
    JOIN users ON users.id = document_views.user_id
    JOIN documents ON documents.id = document_views.document_id
    ORDER BY viewed_at DESC
");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document Activity Log</title>

    <!-- Use SAME CSS as documents page -->
    <link rel="stylesheet" href="/pocogolo/public/css/documents.css">
    <link rel="stylesheet" href="/pocogolo/public/css/style.css">
</head>

<body>

    <?php require __DIR__ . "/../includes/navbar.php"; ?>

    <main class="container">

        <div class="page-header">
            <h1>Document <span>Activity Log</span></h1>
            <p class="page-subtitle">
                Riwayat pengguna yang membuka dokumen
            </p>
        </div>

        <section class="documents-section">

            <div class="documents-header">
                <h2>Riwayat Akses Dokumen</h2>
            </div>

            <div class="documents-table">

                <div class="table-head">
                    <span>Email</span>
                    <span>Dokumen</span>
                    <span>Tanggal</span>
                </div>

                <?php while ($row = $stmt->fetch()): ?>
                <div class="table-row">

                    <div class="doc-name">
                        <div class="doc-icon">👤</div>
                        <div>
                            <div class="doc-title">
                                <?= htmlspecialchars($row['email']) ?>
                            </div>
                            <div class="doc-sub">
                                User Account
                            </div>
                        </div>
                    </div>

                    <span><?= htmlspecialchars($row['title']) ?></span>

                    <span>
                        <?= date("d M Y H:i", strtotime($row['viewed_at'])) ?>
                    </span>

                </div>
                <?php endwhile; ?>

            </div>

        </section>

    </main>

</body>

</html>