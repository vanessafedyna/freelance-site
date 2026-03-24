<?php
declare(strict_types=1);

if (!function_exists('session_cookie_settings')) {
    function session_cookie_settings(): array
    {
        return [
            'lifetime' => 0,
            'path' => '/',
            'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
            'httponly' => true,
            'samesite' => 'Lax',
        ];
    }
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params(session_cookie_settings());
    session_start();
}

if (!function_exists('generate_csrf_token')) {
    function generate_csrf_token(): string
    {
        $token = $_SESSION['csrf_token'] ?? null;

        if (!is_string($token) || $token === '') {
            $token = bin2hex(random_bytes(32));
            $_SESSION['csrf_token'] = $token;
        }

        return $token;
    }
}

if (!function_exists('validate_csrf_token')) {
    function validate_csrf_token(string $token): bool
    {
        $sessionToken = $_SESSION['csrf_token'] ?? null;

        if (!is_string($sessionToken) || $sessionToken === '' || $token === '') {
            return false;
        }

        return hash_equals($sessionToken, $token);
    }
}

if (!function_exists('csrf_input')) {
    function csrf_input(): string
    {
        $token = htmlspecialchars(generate_csrf_token(), ENT_QUOTES, 'UTF-8');

        return '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }
}
