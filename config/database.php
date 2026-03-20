<?php
declare(strict_types=1);

const DB_HOST = 'localhost';
const DB_NAME = 'freelance_site';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_CHARSET = 'utf8mb4';

function getDatabaseConnection(): ?PDO
{
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

    try {
        return new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
    } catch (PDOException $exception) {
        echo 'Erreur de connexion a la base de donnees.';
        return null;
    }
}
