<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../includes/db.php';

$redirectUrl = 'projects.php?deleted=0';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Location: ' . $redirectUrl);
    exit;
}

$projectId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($projectId === false || $projectId === null) {
    header('Location: ' . $redirectUrl);
    exit;
}

try {
    $pdo = get_db_connection();
    $delete = $pdo->prepare('DELETE FROM projects WHERE id = :id');
    $delete->execute(['id' => $projectId]);

    if ($delete->rowCount() > 0) {
        $redirectUrl = 'projects.php?deleted=1';
    }
} catch (Throwable $exception) {
    $redirectUrl = 'projects.php?deleted=0';
}

header('Location: ' . $redirectUrl);
exit;
