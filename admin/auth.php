<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (($_SESSION[ADMIN_SESSION_KEY] ?? false) !== true) {
    header('Location: login.php');
    exit;
}

