<?php
session_start();
if (!isset($_GET['id'])) die("Invalid");
$id = (int) $_GET['id'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Document Viewer</title>

    <style>
    body {
        margin: 0;
        background: #0f172a;
        color: white;
        font-family: Inter, sans-serif;
    }

    .toolbar {
        display: flex;
        gap: 10px;
        padding: 10px;
        background: #020617;
        position: fixed;
        width: 100%;
        z-index: 10;
    }

    button {
        padding: 6px 12px;
        cursor: pointer;
    }

    #viewer {
        margin-top: 60px;
        text-align: center;
    }

    canvas {
        margin: 10px auto;
        display: block;
        background: white;
    }
    </style>

    <script src="/pocogolo/public/pdfjs/pdf.min.js"></script>
</head>

<body oncontextmenu="return false">

    <div class="toolbar">
        <button onclick="prevPage()">◀</button>
        <span id="pageInfo"></span>
        <button onclick="nextPage()">▶</button>
        <button onclick="zoomIn()">＋</button>
        <button onclick="zoomOut()">－</button>

        <?php if (isset($_SESSION['admin'])): ?>
        <a href="download.php?id=<?= $id ?>" style="color:white">Download</a>
        <?php endif; ?>
    </div>

    <div id="viewer">
        <canvas id="pdfCanvas"></canvas>
    </div>

    <script>
    pdfjsLib.GlobalWorkerOptions.workerSrc =
        '/pocogolo/public/pdfjs/pdf.worker.min.js';

    let pdfDoc = null,
        pageNum = 1,
        scale = 1.2,
        canvas = document.getElementById('pdfCanvas'),
        ctx = canvas.getContext('2d');

    const url = 'view.php?id=<?= $id ?>';

    pdfjsLib.getDocument(url).promise.then(function(pdf) {
        pdfDoc = pdf;
        renderPage(pageNum);
    });

    function renderPage(num) {
        pdfDoc.getPage(num).then(function(page) {
            let viewport = page.getViewport({
                scale: scale
            });
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            page.render({
                canvasContext: ctx,
                viewport: viewport
            });

            document.getElementById('pageInfo').innerText =
                `Page ${pageNum} / ${pdfDoc.numPages}`;
        });
    }

    function nextPage() {
        if (pageNum >= pdfDoc.numPages) return;
        pageNum++;
        renderPage(pageNum);
    }

    function prevPage() {
        if (pageNum <= 1) return;
        pageNum--;
        renderPage(pageNum);
    }

    function zoomIn() {
        scale += 0.2;
        renderPage(pageNum);
    }

    function zoomOut() {
        scale = Math.max(0.5, scale - 0.2);
        renderPage(pageNum);
    }
    </script>

</body>

</html>