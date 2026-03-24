<?php
declare(strict_types=1);

if (!function_exists('load_env_file')) {
    function load_env_file(?string $envFile = null): void
    {
        static $loadedFiles = [];

        $envFile = $envFile ?? dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';

        if (isset($loadedFiles[$envFile])) {
            return;
        }

        $loadedFiles[$envFile] = true;

        if (!is_file($envFile) || !is_readable($envFile)) {
            return;
        }

        $lines = file($envFile, FILE_IGNORE_NEW_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '' || $line[0] === '#') {
                continue;
            }

            $separatorPosition = strpos($line, '=');
            if ($separatorPosition === false || $separatorPosition === 0) {
                continue;
            }

            $key = trim(substr($line, 0, $separatorPosition));
            $value = trim(substr($line, $separatorPosition + 1));

            if ($key === '') {
                continue;
            }

            $valueLength = strlen($value);
            if (
                $valueLength >= 2
                && (
                    ($value[0] === '"' && $value[$valueLength - 1] === '"')
                    || ($value[0] === "'" && $value[$valueLength - 1] === "'")
                )
            ) {
                $value = substr($value, 1, -1);
            }

            $_ENV[$key] = $value;
            putenv($key . '=' . $value);
        }
    }
}

load_env_file();
