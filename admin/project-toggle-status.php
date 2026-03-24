<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../includes/db.php';

$redirectUrl = 'projects.php?status=0';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Location: ' . $redirectUrl);
    exit;
}

if (!validate_csrf_token((string) ($_POST['csrf_token'] ?? ''))) {
    http_response_code(403);
    echo 'Requête invalide (CSRF)';
    exit;
}

$projectId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$targetStatus = (string) ($_POST['target_status'] ?? '');

if ($projectId === false || $projectId === null || !in_array($targetStatus, ['0', '1'], true)) {
    header('Location: ' . $redirectUrl);
    exit;
}

try {
    $pdo = get_db_connection();
    $update = $pdo->prepare('UPDATE projects SET is_published = :is_published WHERE id = :id');
    $update->execute([
        'is_published' => (int) $targetStatus,
        'id' => $projectId,
    ]);

    if ($update->rowCount() > 0) {
        $redirectUrl = 'projects.php?status=1';
    }
} catch (Throwable $exception) {
    $redirectUrl = 'projects.php?status=0';
}

header('Location: ' . $redirectUrl);
exit;
