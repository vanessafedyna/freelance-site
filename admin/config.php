<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/env.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name('freelance_admin_session');
}

const ADMIN_SESSION_KEY = 'admin_logged_in';
const ADMIN_SESSION_USERNAME_KEY = 'admin_username';

if (!function_exists('admin_username')) {
    function admin_username(): string
    {
        $value = getenv('ADMIN_USERNAME');
        return $value !== false ? $value : '';
    }
}

if (!function_exists('admin_password_hash')) {
    function admin_password_hash(): string
    {
        $value = getenv('ADMIN_PASSWORD_HASH');
        return $value !== false ? $value : '';
    }
}
