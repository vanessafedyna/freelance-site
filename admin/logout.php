<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/session.php';

$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $params = session_cookie_settings();
    setcookie(
        session_name(),
        '',
        [
            'expires' => time() - 42000,
            'path' => $params['path'],
            'secure' => (bool) $params['secure'],
            'httponly' => (bool) $params['httponly'],
            'samesite' => $params['samesite'],
        ]
    );
}

session_destroy();

header('Location: login.php');
exit;
