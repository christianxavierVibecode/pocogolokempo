<?php
session_start();
require __DIR__ . "/../config/db.php";

/* Only admin */
if (!isset($_SESSION['admin'])) {
    die("Unauthorized");
}

$stmt = $pdo->query("
    SELECT users.email, documents.title, document_views.viewed_at
    FROM document_views
    JOIN users ON users.id = document_views.user_id
    JOIN documents ON documents.id = document_views.document_id
    ORDER BY viewed_at DESC
");
?>
<h2>Document Activity Log</h2>

<table>
    <tr>
        <th>Email</th>
        <th>Document</th>
        <th>Date</th>
    </tr>

    <?php while ($row = $stmt->fetch()): ?>
    <tr>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= $row['viewed_at'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>