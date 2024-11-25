<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

check_login($pdo);

if (!is_logged_in()) {
    header("Location: " . $base_url . "login");
    exit;
}

$uploadDir = getenv("UPLOADS_DIR");

handle_session_timeout($timeout_duration, $base_url);

