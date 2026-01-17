<?php
session_start();
require __DIR__ . "/config/db.php";

/* ===============================
   GET FILE NAME
================================ */
if (!isset($_GET['file_name'])) {
    die("File missing");
}

$fileName = basename($_GET['file_name']);

/* ===============================
   CHECK FILE EXISTS
================================ */
$filePath = __DIR__ . "/private/uploads/" . $fileName;

if (!file_exists($filePath)) {
    die("File not found");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Document</title>

    <style>
    body {
        margin: 0;
        background: #0f172a;
        font-family: Inter, sans-serif;
    }

    .viewer-header {
        position: fixed;
        top: 0;
        width: 100%;
        height: 56px;
        background: #020617;
        color: white;
        display: flex;
        align-items: center;
        padding: 0 20px;
        z-index: 10;
    }

    .viewer-header span {
        font-weight: 500;
    }

    .pdf-container {
        padding-top: 80px;
        padding-bottom: 40px;
        max-width: 900px;
        margin: auto;
    }

    canvas {
        display: block;
        margin: 24px auto;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .45);
        background: white;
        border-radius: 6px;
    }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="viewer-header">
        <span>📄 Document Viewer</span>
    </div>

    <!-- PDF CANVAS -->
    <div id="pdf-container" class="pdf-container"></div>

    <!-- PDF.JS -->
    <script type="module">
    import * as pdfjsLib from "/pocogolo/public/pdfjs/pdfjs-5.4.530-dist/build/pdf.mjs";

    pdfjsLib.GlobalWorkerOptions.workerSrc =
        "/pocogolo/public/pdfjs/pdfjs-5.4.530-dist/build/pdf.worker.mjs";

    const url = "/pocogolo/secure-pdf.php?file=<?= urlencode($fileName) ?>";
    const container = document.getElementById("pdf-container");

    const renderPage = async (pdf, pageNumber) => {
        const page = await pdf.getPage(pageNumber);

        const viewport = page.getViewport({
            scale: 1
        });
        const containerWidth = container.clientWidth - 40;

        const scale = containerWidth / viewport.width;
        const scaledViewport = page.getViewport({
            scale
        });

        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");

        canvas.width = scaledViewport.width;
        canvas.height = scaledViewport.height;

        container.appendChild(canvas);

        await page.render({
            canvasContext: ctx,
            viewport: scaledViewport
        }).promise;
    };

    pdfjsLib.getDocument(url).promise.then(async pdf => {
        for (let i = 1; i <= pdf.numPages; i++) {
            await renderPage(pdf, i);
        }
    }).catch(err => {
        console.error(err);
        alert("Failed to load document");
    });
    </script>


</body>

</html>