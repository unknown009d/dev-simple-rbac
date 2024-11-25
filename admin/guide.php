<?php
// $title = 'Guide';
// $active = -1;
// $pageCategory = null;
// require_once 'header.php';
$bs = getenv("URL_BASE");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Guide | XYZ CMS</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta name="robots" content="noindex">

    <!-- Open Graph meta tags for thumbnail, title, and description -->
    <meta property="og:title" content="Usage of XYZ CMS">
    <meta property="og:description" content="This is a Video Guide showcasing the use of Content Management System for XYZ  Website">
    <meta property="og:image" content="<?= $bs ?>assets/thumbnail.jpg">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="720">
    <meta property="og:url" content="<?= $bs ?>guide">
    <meta property="og:type" content="video.other">

    <!-- You can also add Twitter Card metadata if you want better sharing on Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Usage of XYZ CMS">
    <meta name="twitter:description" content="This is a Video Guide showcasing the use of Content Management System for XYZ  Website">
    <meta name="twitter:image" content="<?= $bs ?>assets/thumbnail.jpg">

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            height: 100%;
            width: 100%;
            background-color: black;
        }

        video {
            width: 100%;
            height: 99.5vh;
        }
    </style>
</head>

<body>
    <video src="assets/XYZCMS.mp4" controls></video>
</body>

</html>


<?php
// require_once 'footer.php';
?>