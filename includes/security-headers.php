<?php
declare(strict_types=1);

if (!headers_sent()) {
    // TODO: eliminer les scripts inline pour retirer 'unsafe-inline'.
    $csp = implode('; ', [
        "default-src 'self'",
        "script-src 'self' 'unsafe-inline'",
        "style-src 'self' 'unsafe-inline'",
        "img-src 'self' data:",
        "font-src 'self'",
        "frame-ancestors 'none'",
        "base-uri 'self'",
        "form-action 'self'",
    ]);

    header('Content-Security-Policy: ' . $csp);
    header('X-Frame-Options: DENY');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');

    $https = (string) ($_SERVER['HTTPS'] ?? '');
    if ($https !== '' && strtolower($https) !== 'off') {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
}
