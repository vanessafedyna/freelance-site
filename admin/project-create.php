<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../includes/db.php';

$allowedCategories = ['site web', 'identité visuelle', 'automatisation'];
$allowedProjectTypes = ['client', 'demo', 'concept'];
$currentYear = (int) date('Y');

$values = [
    'title' => '',
    'slug' => '',
    'category' => 'site web',
    'project_type' => 'demo',
    'project_year' => (string) $currentYear,
    'short_description' => '',
    'result_text' => '',
    'thumbnail' => '',
    'link_url' => '',
    'link_label' => '',
    'is_published' => '1',
    'display_order' => '0',
];

$errors = [];
$formError = '';

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $values['title'] = trim((string) ($_POST['title'] ?? ''));
    $values['slug'] = trim((string) ($_POST['slug'] ?? ''));
    $values['category'] = trim((string) ($_POST['category'] ?? ''));
    $values['project_type'] = trim((string) ($_POST['project_type'] ?? ''));
    $values['project_year'] = trim((string) ($_POST['project_year'] ?? ''));
    $values['short_description'] = trim((string) ($_POST['short_description'] ?? ''));
    $values['result_text'] = trim((string) ($_POST['result_text'] ?? ''));
    $values['thumbnail'] = '';
    if (isset($_FILES['thumbnail_file']) && $_FILES['thumbnail_file']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['thumbnail_file'];
        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors['thumbnail'] = 'Erreur lors du téléversement (code ' . $file['error'] . ').';
        } elseif ($file['size'] > 2 * 1024 * 1024) {
            $errors['thumbnail'] = 'L\'image ne doit pas dépasser 2 Mo.';
        } else {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
            if (!in_array($mime, $allowedMimes, true)) {
                $errors['thumbnail'] = 'Format accepté : JPG, PNG, WebP, GIF.';
            } else {
                $extMap = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'];
                $filename = ($values['slug'] !== '' ? $values['slug'] : uniqid()) . '-' . time() . '.' . $extMap[$mime];
                $uploadDir = __DIR__ . '/../assets/images/projects/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
                    $values['thumbnail'] = 'assets/images/projects/' . $filename;
                } else {
                    $errors['thumbnail'] = 'Impossible de déplacer le fichier téléversé.';
                }
            }
        }
    }
    $values['link_url'] = trim((string) ($_POST['link_url'] ?? ''));
    $values['link_label'] = trim((string) ($_POST['link_label'] ?? ''));
    $values['is_published'] = (string) ($_POST['is_published'] ?? '0');
    $values['display_order'] = trim((string) ($_POST['display_order'] ?? '0'));

    if ($values['title'] === '') {
        $errors['title'] = 'Le titre est obligatoire.';
    }

    if ($values['slug'] === '') {
        $errors['slug'] = 'Le slug est obligatoire.';
    } elseif (!preg_match('/^[a-z0-9-]+$/', $values['slug'])) {
        $errors['slug'] = 'Le slug doit contenir uniquement des lettres minuscules, des chiffres et des tirets.';
    }

    if (!in_array($values['category'], $allowedCategories, true)) {
        $errors['category'] = 'La catégorie est invalide.';
    }

    if (!in_array($values['project_type'], $allowedProjectTypes, true)) {
        $errors['project_type'] = 'Le type de projet est invalide.';
    }

    if ($values['project_year'] === '' || filter_var($values['project_year'], FILTER_VALIDATE_INT) === false) {
        $errors['project_year'] = 'L’année doit être un nombre entier.';
    } else {
        $year = (int) $values['project_year'];
        if ($year < 2000 || $year > ($currentYear + 1)) {
            $errors['project_year'] = 'L’année est hors plage autorisée.';
        }
    }

    if ($values['short_description'] === '') {
        $errors['short_description'] = 'La description courte est obligatoire.';
    }

    if ($values['result_text'] === '') {
        $errors['result_text'] = 'Le résultat est obligatoire.';
    }

    if (!in_array($values['is_published'], ['0', '1'], true)) {
        $errors['is_published'] = 'Le statut de publication est invalide.';
    }

    if ($values['display_order'] === '' || filter_var($values['display_order'], FILTER_VALIDATE_INT) === false) {
        $errors['display_order'] = 'L’ordre d’affichage doit être un entier.';
    } elseif ((int) $values['display_order'] < 0) {
        $errors['display_order'] = 'L’ordre d’affichage doit être supérieur ou égal à 0.';
    }

    if ($values['link_url'] !== '' && $values['link_label'] === '') {
        $values['link_label'] = 'Parler d’un projet similaire';
    }

    if (empty($errors)) {
        try {
            $pdo = get_db_connection();

            $checkSlug = $pdo->prepare('SELECT COUNT(*) FROM projects WHERE slug = :slug');
            $checkSlug->execute(['slug' => $values['slug']]);
            $slugExists = ((int) $checkSlug->fetchColumn()) > 0;

            if ($slugExists) {
                $errors['slug'] = 'Ce slug est déjà utilisé.';
            } else {
                $insert = $pdo->prepare(
                    'INSERT INTO projects (
                        title,
                        slug,
                        category,
                        project_type,
                        project_year,
                        short_description,
                        result_text,
                        thumbnail,
                        link_url,
                        link_label,
                        is_published,
                        display_order
                    ) VALUES (
                        :title,
                        :slug,
                        :category,
                        :project_type,
                        :project_year,
                        :short_description,
                        :result_text,
                        :thumbnail,
                        :link_url,
                        :link_label,
                        :is_published,
                        :display_order
                    )'
                );

                $insert->execute([
                    'title' => $values['title'],
                    'slug' => $values['slug'],
                    'category' => $values['category'],
                    'project_type' => $values['project_type'],
                    'project_year' => (int) $values['project_year'],
                    'short_description' => $values['short_description'],
                    'result_text' => $values['result_text'],
                    'thumbnail' => $values['thumbnail'] !== '' ? $values['thumbnail'] : null,
                    'link_url' => $values['link_url'] !== '' ? $values['link_url'] : null,
                    'link_label' => $values['link_label'] !== '' ? $values['link_label'] : null,
                    'is_published' => (int) $values['is_published'],
                    'display_order' => (int) $values['display_order'],
                ]);

                header('Location: projects.php?created=1');
                exit;
            }
        } catch (Throwable $exception) {
            $formError = 'Impossible d’enregistrer le projet pour le moment.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un projet</title>
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
            width: min(94vw, 880px);
            margin: 2rem auto;
        }

        .topbar {
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

        .link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            padding: 0.55rem 0.8rem;
            border-radius: 10px;
            border: 1px solid #d8d0c2;
            background: #ffffff;
            color: #111318;
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 600;
        }

        .card {
            border: 1px solid #d8d0c2;
            border-radius: 12px;
            background: #ffffff;
            padding: 1rem;
            box-shadow: 0 8px 22px rgba(17, 19, 24, 0.08);
        }

        .grid {
            display: grid;
            gap: 0.9rem;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .field {
            display: grid;
            gap: 0.4rem;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 0.92rem;
            font-weight: 600;
        }

        input,
        select,
        textarea {
            border: 1px solid #d8d0c2;
            border-radius: 8px;
            padding: 0.65rem 0.75rem;
            font: inherit;
            color: #111318;
            background: #ffffff;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        input[type="file"] {
            padding: 0.4rem 0.5rem;
            cursor: pointer;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid #2f6b66;
            outline-offset: 1px;
            border-color: #2f6b66;
        }

        .error-list,
        .error-text,
        .global-error {
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .error-list,
        .global-error {
            border: 1px solid #e2aaaa;
            background: #fdeeee;
            color: #932727;
            padding: 0.75rem;
            margin: 0 0 1rem;
        }

        .error-list ul {
            margin: 0;
            padding-left: 1.15rem;
        }

        .error-text {
            color: #932727;
        }

        .submit {
            margin-top: 1rem;
            border: 1px solid #111318;
            border-radius: 10px;
            background: #111318;
            color: #f5f1e8;
            padding: 0.65rem 0.95rem;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
        }

        .submit:hover {
            background: #2f6b66;
            border-color: #2f6b66;
        }

        @media (max-width: 720px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <div class="topbar">
            <h1>Ajouter un projet</h1>
            <a class="link" href="projects.php">Retour aux projets</a>
        </div>

        <section class="card">
            <?php if (!empty($errors)): ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo h($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($formError !== ''): ?>
                <p class="global-error"><?php echo h($formError); ?></p>
            <?php endif; ?>

            <form method="post" action="project-create.php" enctype="multipart/form-data" novalidate>
                <div class="grid">
                    <div class="field full">
                        <label for="title">Titre</label>
                        <input id="title" name="title" type="text" value="<?php echo h($values['title']); ?>" required>
                    </div>

                    <div class="field full">
                        <label for="slug">Slug</label>
                        <input id="slug" name="slug" type="text" value="<?php echo h($values['slug']); ?>" required>
                    </div>

                    <div class="field">
                        <label for="category">Catégorie</label>
                        <select id="category" name="category" required>
                            <?php foreach ($allowedCategories as $category): ?>
                                <option value="<?php echo h($category); ?>" <?php echo $values['category'] === $category ? 'selected' : ''; ?>>
                                    <?php echo h($category); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="field">
                        <label for="project_type">Type de projet</label>
                        <select id="project_type" name="project_type" required>
                            <?php foreach ($allowedProjectTypes as $projectType): ?>
                                <option value="<?php echo h($projectType); ?>" <?php echo $values['project_type'] === $projectType ? 'selected' : ''; ?>>
                                    <?php echo h($projectType); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="field">
                        <label for="project_year">Année</label>
                        <input id="project_year" name="project_year" type="number" min="2000" max="<?php echo h((string) ($currentYear + 1)); ?>" value="<?php echo h($values['project_year']); ?>" required>
                    </div>

                    <div class="field">
                        <label for="display_order">Ordre d’affichage</label>
                        <input id="display_order" name="display_order" type="number" min="0" value="<?php echo h($values['display_order']); ?>" required>
                    </div>

                    <div class="field full">
                        <label for="short_description">Description courte</label>
                        <textarea id="short_description" name="short_description" required><?php echo h($values['short_description']); ?></textarea>
                    </div>

                    <div class="field full">
                        <label for="result_text">Résultat</label>
                        <textarea id="result_text" name="result_text" required><?php echo h($values['result_text']); ?></textarea>
                    </div>

                    <div class="field full">
                        <label for="thumbnail_file">Miniature (JPG, PNG, WebP, GIF — max 2 Mo)</label>
                        <input id="thumbnail_file" name="thumbnail_file" type="file" accept="image/jpeg,image/png,image/webp,image/gif">
                        <?php if (isset($errors['thumbnail'])): ?>
                            <span class="error-text"><?php echo h($errors['thumbnail']); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="field full">
                        <label for="link_url">URL du lien</label>
                        <input id="link_url" name="link_url" type="text" value="<?php echo h($values['link_url']); ?>">
                    </div>

                    <div class="field full">
                        <label for="link_label">Libellé du lien</label>
                        <input id="link_label" name="link_label" type="text" value="<?php echo h($values['link_label']); ?>">
                    </div>

                    <div class="field">
                        <label for="is_published">Publication</label>
                        <select id="is_published" name="is_published">
                            <option value="1" <?php echo $values['is_published'] === '1' ? 'selected' : ''; ?>>Publié</option>
                            <option value="0" <?php echo $values['is_published'] === '0' ? 'selected' : ''; ?>>Brouillon</option>
                        </select>
                    </div>
                </div>

                <button class="submit" type="submit">Enregistrer le projet</button>
            </form>
        </section>
    </main>
</body>
</html>