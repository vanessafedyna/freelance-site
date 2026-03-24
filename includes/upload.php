<?php
declare(strict_types=1);

if (!function_exists('handle_thumbnail_upload')) {
    function handle_thumbnail_upload(array $file, string $slug): array
    {
        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            return [
                'success' => false,
                'filename' => '',
                'error' => 'Erreur lors du téléversement (code ' . (string) ($file['error'] ?? 'inconnu') . ').',
            ];
        }

        if (($file['size'] ?? 0) > 2 * 1024 * 1024) {
            return [
                'success' => false,
                'filename' => '',
                'error' => 'L\'image ne doit pas dépasser 2 Mo.',
            ];
        }

        $tmpName = (string) ($file['tmp_name'] ?? '');
        if ($tmpName === '') {
            return [
                'success' => false,
                'filename' => '',
                'error' => 'Fichier téléversé invalide.',
            ];
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = $finfo !== false ? finfo_file($finfo, $tmpName) : false;
        if ($finfo !== false) {
            finfo_close($finfo);
        }

        if (!is_string($mime) || !in_array($mime, $allowedMimes, true)) {
            return [
                'success' => false,
                'filename' => '',
                'error' => 'Format accepté : JPG, PNG, WebP, GIF.',
            ];
        }

        $extMap = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'];
        $baseName = $slug !== '' ? $slug : uniqid('', true);
        $filename = $baseName . '-' . time() . '.' . $extMap[$mime];
        $uploadDir = __DIR__ . '/../assets/images/projects/';

        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
            return [
                'success' => false,
                'filename' => '',
                'error' => 'Impossible de préparer le dossier d\'upload.',
            ];
        }

        if (!move_uploaded_file($tmpName, $uploadDir . $filename)) {
            return [
                'success' => false,
                'filename' => '',
                'error' => 'Impossible de déplacer le fichier téléversé.',
            ];
        }

        return [
            'success' => true,
            'filename' => $filename,
            'error' => '',
        ];
    }
}
