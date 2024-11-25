<?php

$rem_me = isset($_COOKIE['rememberme']);
header("Location: " . ($rem_me ? 'intro' : 'login'));
?>

<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Management System for XYZ </title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta name="robots" content="noindex">
</head>

<body>

</body>

</html>