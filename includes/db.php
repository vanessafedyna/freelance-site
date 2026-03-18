<?php
declare(strict_types=1);

/**
 * Configuration MySQL (a modifier selon votre environnement).
 */
const DB_HOST = '127.0.0.1';
const DB_NAME = 'freelance_site';
const DB_USER = 'db_user';
const DB_PASS = 'db_password';
const DB_CHARSET = 'utf8mb4';

/**
 * Retourne une connexion PDO reutilisable.
 */
function get_db_connection(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=%s',
        DB_HOST,
        DB_NAME,
        DB_CHARSET
    );

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    return $pdo;
}
