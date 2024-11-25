<?php
$dsn = 'mysql:host=localhost;dbname=' . getenv("DB_NAME");
$username = getenv("DB_USER");
$password = getenv("DB_PASS");

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$timeout_duration = 1800; // Session timeout duration (1800 seconds = 30 minutes)
$rootdir = getenv("ROOT_DIR") . 'admin';
$base_url = getenv("URL_BASE");
