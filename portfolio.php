<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/db.php';

// Récupération des projets publiés, avec fallback silencieux en cas d'erreur.
$projects = [];

try {
    $pdo = get_db_connection();
    $sql = 'SELECT id, title, slug, category, project_type, project_year, short_description, result_text, thumbnail, link_url, link_label
            FROM projects
            WHERE is_published = 1
            ORDER BY display_order ASC, created_at DESC';
    $stmt = $pdo->query($sql);
    $projects = $stmt->fetchAll();
} catch (Throwable $exception) {
    $projects = [];
}

$page_title = 'Portfolio freelance | Projets web, identité visuelle et automatisations | MONATECH';
$page_description = 'Sélection de projets web, identité visuelle essentielle et automatisations pour petites entreprises. Exemples concrets de réalisations, démos et concepts.';
$page_keywords = 'portfolio freelance, projets web, identité visuelle, automatisations, petites entreprises';
$page_path = 'portfolio.php';

include('includes/header.php');
?>

<main class="portfolio-page">
    <section class="section portfolio-hero">
        <div class="container portfolio-hero-inner">
            <div class="portfolio-hero-layout">
                <div class="portfolio-hero-copy" data-reveal>
                    <p class="hero-badge">Projets et réalisations</p>
                    <h1>Des projets concrets, pas des promesses.</h1>
                    <p class="portfolio-intro">Vous trouverez ici des projets clients, des démos et des concepts qui montrent comment je travaille.</p>
                    <a href="contact.php" class="btn btn-primary">
                        <span class="button-outer"><span class="button-inner"><span class="button-text">Demander un devis gratuit</span></span></span>
                    </a>
                </div>

                <aside class="portfolio-hero-aside" data-reveal aria-label="Valeur apportée">
                    <h2>Quelques projets récents.</h2>
                    <ul class="portfolio-highlight-list">
                        <li>Des sites pensés pour mieux présenter une offre.</li>
                        <li>Une image plus claire et plus cohérente.</li>
                        <li>Des solutions faciles à utiliser au quotidien.</li>
                    </ul>
                </aside>
            </div>
        </div>
    </section>

    <section class="section portfolio-grid-section">
        <div class="container">
            <?php if (empty($projects)): ?>
                <div class="portfolio-empty">
                    <p>Aucun projet n’est publié pour le moment.</p>
                </div>
            <?php else: ?>
                <div class="portfolio-grid">
                    <?php foreach ($projects as $project): ?>
                        <?php
                        $category = trim((string) ($project['category'] ?? ''));
                        $categoryLower = function_exists('mb_strtolower') ? mb_strtolower($category, 'UTF-8') : strtolower($category);
                        $projectTypeRaw = trim((string) ($project['project_type'] ?? ''));
                        $projectType = function_exists('mb_strtolower') ? mb_strtolower($projectTypeRaw, 'UTF-8') : strtolower($projectTypeRaw);

                        if ($projectType === 'client') {
                            $projectTypeLabel = 'Projet client';
                        } elseif ($projectType === 'demo') {
                            $projectTypeLabel = 'Démo';
                        } elseif ($projectType === 'concept') {
                            $projectTypeLabel = 'Concept';
                        } else {
                            $projectTypeLabel = 'Projet';
                        }

                        $thumbnailValue = trim((string) ($project['thumbnail'] ?? ''));
                        $hasThumbnailImage = $thumbnailValue !== '' && (bool) preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $thumbnailValue);

                        $thumbnailText = $thumbnailValue;
                        if (!$hasThumbnailImage) {
                            if (str_contains($categoryLower, 'site')) {
                                $thumbnailText = 'Site web';
                            } elseif (str_contains($categoryLower, 'identité') || str_contains($categoryLower, 'identite') || str_contains($categoryLower, 'visuelle')) {
                                $thumbnailText = 'Identité';
                            } elseif (str_contains($categoryLower, 'automatisation')) {
                                $thumbnailText = 'Automatisation';
                            } else {
                                $thumbnailText = 'Projet';
                            }
                        }

                        $projectYear = trim((string) ($project['project_year'] ?? ''));
                        $title = trim((string) ($project['title'] ?? ''));
                        $shortDescription = trim((string) ($project['short_description'] ?? ''));
                        $resultText = trim((string) ($project['result_text'] ?? ''));
                        $linkUrl = trim((string) ($project['link_url'] ?? ''));
                        $linkLabel = trim((string) ($project['link_label'] ?? ''));

                        if ($category === '') {
                            $category = 'Projet';
                        }

                        if ($projectYear === '') {
                            $projectYear = '—';
                        }

                        if ($title === '') {
                            $title = 'Projet';
                        }

                        if ($shortDescription === '') {
                            $shortDescription = 'Description du projet à venir.';
                        }

                        if ($resultText === '') {
                            $resultText = 'Projet en cours de finalisation.';
                        }

                        $hasExternalLink = $linkUrl !== '';
                        if ($linkLabel === '') {
                            $linkLabel = 'Voir le projet';
                        }
                        ?>
                        <article class="project-card project-hover-card" data-reveal>
                            <div class="project-thumb project-hover-media">
                                <?php if ($hasThumbnailImage): ?>
                                    <img src="<?php echo htmlspecialchars($thumbnailValue, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy" width="600" height="400" style="aspect-ratio: 3/2; object-fit: cover;">
                                <?php else: ?>
                                    <?php echo htmlspecialchars($thumbnailText, ENT_QUOTES, 'UTF-8'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="project-head">
                                <p class="project-category"><?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?></p>
                                <span class="project-year"><?php echo htmlspecialchars($projectYear, ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                            <p class="project-type-badge"><?php echo htmlspecialchars($projectTypeLabel, ENT_QUOTES, 'UTF-8'); ?></p>
                            <h2><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h2>
                            <p><?php echo htmlspecialchars($shortDescription, ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="project-result">Résultat : <?php echo htmlspecialchars($resultText, ENT_QUOTES, 'UTF-8'); ?></p>
                            <div class="project-footer">
                                <?php if ($hasExternalLink): ?>
                                    <a href="<?php echo htmlspecialchars($linkUrl, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary btn-sm project-view-link" target="_blank" rel="noopener noreferrer">
                                        <span class="button-outer"><span class="button-inner"><span class="button-text"><?php echo htmlspecialchars($linkLabel, ENT_QUOTES, 'UTF-8'); ?> ↗</span></span></span>
                                    </a>
                                <?php endif; ?>
                                <a href="contact.php" class="project-link project-hover-link">Parler d'un projet similaire</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="section portfolio-values">
        <div class="container">
            <h2 class="section-title" data-reveal>Ma façon de travailler</h2>
            <div class="portfolio-values-layout">
                <div class="portfolio-values-editorial" data-reveal>
                    <p>Je pars toujours de vos objectifs : être plus clair, plus crédible et plus facile à contacter.</p>
                    <p>Le design sert à faire comprendre, rassurer et donner envie d'avancer.</p>
                </div>

                <div class="portfolio-values-grid">
                    <article class="value-card" data-reveal>
                        <h3>Approche sur mesure</h3>
                        <p>Chaque projet part de votre réalité, pas d'un modèle générique.</p>
                    </article>
                    <article class="value-card" data-reveal>
                        <h3>Design professionnel</h3>
                        <p>Je cherche un rendu clair, pro et facile à comprendre dès la première visite.</p>
                    </article>
                    <article class="value-card" data-reveal>
                        <h3>Solutions adaptées aux petites entreprises</h3>
                        <p>Je privilégie des choix simples à maintenir et adaptés à votre budget.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="section portfolio-final-cta">
        <div class="container cta-box portfolio-cta-shell" data-reveal>
            <h2>On parle du vôtre ?</h2>
            <p>Si vous avez un projet en tête, je peux vous aider à le rendre clair, utile et crédible.</p>
            <a href="contact.php" class="btn btn-primary">
                <span class="button-outer"><span class="button-inner"><span class="button-text">Demander un devis gratuit</span></span></span>
            </a>
        </div>
    </section>
</main>

<?php include('includes/footer.php'); ?>
