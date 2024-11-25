<?php
require_once "config.php";
require_once "functions.php";
require_once "icon.php";

$msg = $_GET['message'];

$root = getenv("ROOT_DIR");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="<?= $root ?>css/main.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta name="robots" content="noindex">
    <script src="main.js" defer></script>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="admin bg-white sm:bg-slate-100 dark:bg-gray-900 sm:dark:bg-gray-800 h-screen grid place-items-center">
    <p class="dark:text-white"><?= $msg ?></p>
</body>

</html>