<?php
declare(strict_types=1);

require_once __DIR__ . '/env.php';

/**
 * Retourne une connexion PDO reutilisable.
 */
function get_db_connection(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dbHost = getenv('DB_HOST');
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPass = getenv('DB_PASS');
    $dbCharset = getenv('DB_CHARSET');

    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=%s',
        $dbHost !== false ? $dbHost : '',
        $dbName !== false ? $dbName : '',
        $dbCharset !== false ? $dbCharset : ''
    );

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO(
        $dsn,
        $dbUser !== false ? $dbUser : '',
        $dbPass !== false ? $dbPass : '',
        $options
    );

    return $pdo;
}
