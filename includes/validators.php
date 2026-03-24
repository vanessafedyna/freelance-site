<?php
declare(strict_types=1);

if (!function_exists('validate_project_url')) {
    function validate_project_url(string $url): ?string
    {
        if ($url === '') {
            return null;
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            return "L'URL du projet doit être une URL valide (http ou https).";
        }

        $scheme = parse_url($url, PHP_URL_SCHEME);
        if (!is_string($scheme) || !in_array(strtolower($scheme), ['http', 'https'], true)) {
            return "L'URL du projet doit être une URL valide (http ou https).";
        }

        return null;
    }
}
