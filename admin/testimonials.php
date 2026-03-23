<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../includes/db.php';

function h(string $v): string
{
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}

$pdo = get_db_connection();

// Actions
$action = trim((string) ($_POST['action'] ?? ''));
$id     = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?: 0;

if ($action === 'approve' && $id > 0) {
    $pdo->prepare('UPDATE testimonials SET is_approved = 1 WHERE id = :id')->execute(['id' => $id]);
    header('Location: testimonials.php?done=approved');
    exit;
}

if ($action === 'delete' && $id > 0) {
    $pdo->prepare('DELETE FROM testimonials WHERE id = :id')->execute(['id' => $id]);
    header('Location: testimonials.php?done=deleted');
    exit;
}

$testimonials = $pdo->query('SELECT * FROM testimonials ORDER BY is_approved ASC, created_at DESC')->fetchAll();
$done = $_GET['done'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Témoignages — Admin</title>
    <style>
        :root { font-family: Arial, sans-serif; }
        body { margin: 0; background: #f5f1e8; color: #111318; }
        .container { width: min(94vw, 900px); margin: 2rem auto; }
        .topbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; }
        h1 { margin: 0; font-size: 1.6rem; }
        .link { display: inline-flex; align-items: center; min-height: 38px; padding: 0.5rem 0.8rem; border-radius: 10px; border: 1px solid #d8d0c2; background: #fff; color: #111318; text-decoration: none; font-size: 0.92rem; font-weight: 600; }
        .alert { padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.9rem; }
        .alert-success { background: #edf7ed; border: 1px solid #a3d9a3; color: #1e6b1e; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 22px rgba(17,19,24,0.08); }
        th { background: #111318; color: #f5f1e8; text-align: left; padding: 0.75rem 1rem; font-size: 0.85rem; }
        td { padding: 0.85rem 1rem; border-bottom: 1px solid #eae4d8; font-size: 0.9rem; vertical-align: top; }
        tr:last-child td { border-bottom: none; }
        .badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 6px; font-size: 0.78rem; font-weight: 700; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-approved { background: #d1e7dd; color: #0a3622; }
        .actions { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .btn-approve { padding: 0.4rem 0.8rem; background: #2f6b66; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; }
        .btn-delete { padding: 0.4rem 0.8rem; background: #932727; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; }
        .empty { text-align: center; padding: 2rem; color: #555; }
    </style>
</head>
<body>
    <main class="container">
        <div class="topbar">
            <h1>Témoignages</h1>
            <a class="link" href="projects.php">← Retour</a>
        </div>

        <?php if ($done === 'approved'): ?>
            <div class="alert alert-success">Avis approuvé et publié.</div>
        <?php elseif ($done === 'deleted'): ?>
            <div class="alert alert-success">Avis supprimé.</div>
        <?php endif; ?>

        <?php if (empty($testimonials)): ?>
            <p class="empty">Aucun témoignage reçu pour le moment.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Poste</th>
                        <th>Avis</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($testimonials as $t): ?>
                        <tr>
                            <td><strong><?php echo h((string)$t['name']); ?></strong></td>
                            <td><?php echo h((string)($t['job_title'] ?? '—')); ?></td>
                            <td><?php echo h(mb_substr((string)$t['message'], 0, 120)); ?>…</td>
                            <td>
                                <?php if ($t['is_approved']): ?>
                                    <span class="badge badge-approved">Publié</span>
                                <?php else: ?>
                                    <span class="badge badge-pending">En attente</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo h(date('d/m/Y', strtotime((string)$t['created_at']))); ?></td>
                            <td>
                                <div class="actions">
                                    <?php if (!$t['is_approved']): ?>
                                        <form method="post">
                                            <input type="hidden" name="action" value="approve">
                                            <input type="hidden" name="id" value="<?php echo (int)$t['id']; ?>">
                                            <button class="btn-approve" type="submit">Approuver</button>
                                        </form>
                                    <?php endif; ?>
                                    <form method="post" onsubmit="return confirm('Supprimer cet avis ?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo (int)$t['id']; ?>">
                                        <button class="btn-delete" type="submit">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>
