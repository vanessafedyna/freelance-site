<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/session.php';

if (($_SESSION[ADMIN_SESSION_KEY] ?? false) !== true) {
    header('Location: login.php');
    exit;
}
