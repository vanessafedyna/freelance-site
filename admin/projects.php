<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/security-headers.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../includes/db.php';

$projects = [];
$loadError = false;
$flashMessage = '';

try {
    $pdo = get_db_connection();
    $sql = 'SELECT id, title, category, project_type, project_year, is_published, display_order
            FROM projects
            ORDER BY display_order ASC, created_at DESC';
    $stmt = $pdo->query($sql);
    $projects = $stmt->fetchAll();
} catch (Throwable $exception) {
    $loadError = true;
    $projects = [];
}

$adminUsername = (string) ($_SESSION[ADMIN_SESSION_USERNAME_KEY] ?? admin_username());

if (($_GET['created'] ?? '') === '1') {
    $flashMessage = 'Projet ajouté avec succès.';
} elseif (($_GET['updated'] ?? '') === '1') {
    $flashMessage = 'Projet mis à jour avec succès.';
} elseif (($_GET['deleted'] ?? '') === '1') {
    $flashMessage = 'Projet supprimé avec succès.';
} elseif (($_GET['deleted'] ?? '') === '0') {
    $flashMessage = 'Impossible de supprimer le projet.';
} elseif (($_GET['status'] ?? '') === '1') {
    $flashMessage = 'Statut du projet mis à jour avec succès.';
} elseif (($_GET['status'] ?? '') === '0') {
    $flashMessage = 'Impossible de mettre à jour le statut du projet.';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Gestion des projets</title>
    <style>
        :root {
            font-family: Arial, sans-serif;
            color-scheme: light;
        }

        body {
            margin: 0;
            background: #f5f1e8;
            color: #111318;
        }

        .container {
            width: min(94vw, 1060px);
            margin: 2rem auto;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        h1 {
            margin: 0;
            font-size: 1.6rem;
        }

        .intro {
            margin: 0.45rem 0 1.2rem;
            color: #2b313c;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .flash {
            margin: 0 0 1rem;
            padding: 0.85rem 0.95rem;
            border: 1px solid #9fc8b0;
            border-radius: 10px;
            background: #edf8f1;
            color: #234f37;
            font-size: 0.92rem;
        }

        .btn,
        .link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            padding: 0.55rem 0.8rem;
            border-radius: 10px;
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 600;
        }

        .btn {
            border: 1px solid #111318;
            background: #111318;
            color: #f5f1e8;
        }

        .btn:hover {
            background: #2f6b66;
            border-color: #2f6b66;
        }

        .link {
            border: 1px solid #d8d0c2;
            background: #ffffff;
            color: #111318;
        }

        .card {
            border: 1px solid #d8d0c2;
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
            box-shadow: 0 8px 22px rgba(17, 19, 24, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 0.7rem 0.75rem;
            border-bottom: 1px solid #ece6dc;
            font-size: 0.92rem;
            vertical-align: top;
        }

        th {
            background: #f7f4ed;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #2b313c;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status {
            font-weight: 600;
        }

        .status-published {
            color: #1f6b43;
        }

        .status-draft {
            color: #8a5b1f;
        }

        .table-actions {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .table-actions form {
            margin: 0;
        }

        .table-actions a,
        .table-actions button {
            font-size: 0.85rem;
            font-family: inherit;
            line-height: 1.2;
            padding: 0.3rem 0.45rem;
            border-radius: 7px;
            border: 1px solid #d8d0c2;
            background: #f7f4ed;
            color: #111318;
            text-decoration: none;
        }

        .table-actions button {
            cursor: pointer;
        }

        .table-actions .action-danger {
            border-color: #e0b9b9;
            background: #fff3f3;
            color: #7b1f1f;
        }

        .message {
            margin: 0;
            padding: 0.95rem;
            border-radius: 10px;
            border: 1px solid #d8d0c2;
            background: #ffffff;
            color: #2b313c;
        }
    </style>
</head>
<body>
    <main class="container">
        <div class="header">
            <h1>Gestion des projets</h1>
            <a class="link" href="logout.php">Déconnexion</a>
        </div>

        <p class="intro">
            Bonjour <?php echo htmlspecialchars($adminUsername, ENT_QUOTES, 'UTF-8'); ?>, voici la liste des projets enregistrés.
        </p>

        <?php if ($flashMessage !== ''): ?>
            <p class="flash"><?php echo htmlspecialchars($flashMessage, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>

        <div class="actions">
            <a class="btn" href="project-create.php">Ajouter un projet</a>
            <a class="btn" href="testimonials.php">Gérer les témoignages</a>
        </div>

        <?php if ($loadError): ?>
            <p class="message">Impossible de charger les projets pour le moment.</p>
        <?php elseif (empty($projects)): ?>
            <p class="message">Aucun projet enregistré.</p>
        <?php else: ?>
            <section class="card" aria-label="Tableau des projets">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Type</th>
                            <th>Année</th>
                            <th>Statut</th>
                            <th>Ordre</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projects as $project): ?>
                            <?php
                            $id = (int) ($project['id'] ?? 0);
                            $statusPublished = ((int) ($project['is_published'] ?? 0) === 1);
                            $statusText = $statusPublished ? 'Publié' : 'Brouillon';
                            $targetStatus = $statusPublished ? '0' : '1';
                            $toggleLabel = $statusPublished ? 'Passer en brouillon' : 'Publier';
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars((string) ($project['title'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars((string) ($project['category'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars((string) ($project['project_type'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars((string) ($project['project_year'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <span class="status <?php echo $statusPublished ? 'status-published' : 'status-draft'; ?>">
                                        <?php echo htmlspecialchars($statusText, ENT_QUOTES, 'UTF-8'); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars((string) ($project['display_order'] ?? 0), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <div class="table-actions">
                                        <a href="project-edit.php?id=<?php echo urlencode((string) $id); ?>">Modifier</a>

                                        <form method="post" action="project-toggle-status.php">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8'); ?>">
                                            <input type="hidden" name="target_status" value="<?php echo htmlspecialchars($targetStatus, ENT_QUOTES, 'UTF-8'); ?>">
                                            <?php echo csrf_input(); ?>
                                            <button type="submit"><?php echo htmlspecialchars($toggleLabel, ENT_QUOTES, 'UTF-8'); ?></button>
                                        </form>

                                        <form method="post" action="project-delete.php">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8'); ?>">
                                            <?php echo csrf_input(); ?>
                                            <button type="submit" class="action-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php endif; ?>
    </main>
</body>
</html>
