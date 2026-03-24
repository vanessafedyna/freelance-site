<?php
declare(strict_types=1);

if (!function_exists('is_login_blocked')) {
    function is_login_blocked(PDO $pdo, string $ip): bool
    {
        $statement = $pdo->prepare(
            'SELECT COUNT(*)
             FROM login_attempts
             WHERE ip_address = :ip
               AND attempted_at >= (NOW() - INTERVAL 15 MINUTE)'
        );
        $statement->execute(['ip' => $ip]);

        return (int) $statement->fetchColumn() >= 5;
    }
}

if (!function_exists('record_failed_attempt')) {
    function record_failed_attempt(PDO $pdo, string $ip): void
    {
        $statement = $pdo->prepare(
            'INSERT INTO login_attempts (ip_address) VALUES (:ip)'
        );
        $statement->execute(['ip' => $ip]);
    }
}

if (!function_exists('clear_attempts')) {
    function clear_attempts(PDO $pdo, string $ip): void
    {
        $statement = $pdo->prepare(
            'DELETE FROM login_attempts WHERE ip_address = :ip'
        );
        $statement->execute(['ip' => $ip]);
    }
}

if (!function_exists('purge_old_attempts')) {
    function purge_old_attempts(PDO $pdo): void
    {
        $statement = $pdo->prepare(
            'DELETE FROM login_attempts
             WHERE attempted_at < (NOW() - INTERVAL 24 HOUR)'
        );
        $statement->execute();
    }
}
