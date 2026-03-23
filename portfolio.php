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
$page_description = 'Sélection de projets web, identité visuelle simple et automatisations pour petites entreprises. Exemples concrets de réalisations, démos et concepts.';
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
                    <h1>Une sélection de projets web et d’exemples concrets.</h1>
                    <p class="portfolio-intro">
                        Cette sélection présente des projets clients, des démos et des concepts montrant ma manière de concevoir des sites web clairs, une identité visuelle simple et des automatisations utiles.
                    </p>
                    <a href="contact.php" class="btn btn-primary">
                        <span class="button-outer"><span class="button-inner"><span class="button-text">Demander un devis</span></span></span>
                    </a>
                </div>

                <aside class="portfolio-hero-aside" data-reveal aria-label="Valeur apportée">
                    <h2>Ce que cette sélection met en avant</h2>
                    <ul class="portfolio-highlight-list">
                        <li>Des sites pensés pour mieux présenter une offre.</li>
                        <li>Une image plus claire et plus cohérente.</li>
                        <li>Des solutions simples à utiliser au quotidien.</li>
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

                        if ($linkUrl === '') {
                            $linkUrl = 'contact.php';
                            $linkLabel = 'Parler d’un projet similaire';
                        } elseif ($linkLabel === '') {
                            $linkLabel = 'Parler d’un projet similaire';
                        }
                        ?>
                        <article class="project-card project-hover-card" data-reveal>
                            <div class="project-thumb project-hover-media">
                                <?php if ($hasThumbnailImage): ?>
                                    <img src="<?php echo htmlspecialchars($thumbnailValue, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
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
                                <a href="<?php echo htmlspecialchars($linkUrl, ENT_QUOTES, 'UTF-8'); ?>" class="project-link project-hover-link"><?php echo htmlspecialchars($linkLabel, ENT_QUOTES, 'UTF-8'); ?></a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="section portfolio-values">
        <div class="container">
            <h2 class="section-title" data-reveal>Une approche orientée résultats</h2>
            <div class="portfolio-values-layout">
                <div class="portfolio-values-editorial" data-reveal>
                    <p>
                        Chaque mandat débute par une lecture précise de vos objectifs : visibilité,
                        crédibilité et génération de contacts.
                    </p>
                    <p>
                        Le design n’est pas décoratif. Il sert la clarté, la confiance et la prise de décision.
                        Le résultat final reste simple à faire évoluer dans le temps.
                    </p>
                </div>

                <div class="portfolio-values-grid">
                    <article class="value-card" data-reveal>
                        <h3>Approche sur mesure</h3>
                        <p>Chaque projet est construit selon vos objectifs commerciaux et votre réalité terrain.</p>
                    </article>
                    <article class="value-card" data-reveal>
                        <h3>Design professionnel</h3>
                        <p>Des interfaces modernes et claires pour renforcer votre crédibilité dès la première visite.</p>
                    </article>
                    <article class="value-card" data-reveal>
                        <h3>Solutions adaptées aux petites entreprises</h3>
                        <p>Des choix pragmatiques, simples à maintenir et alignés avec votre budget.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="section portfolio-final-cta">
        <div class="container cta-box portfolio-cta-shell" data-reveal>
            <h2>Parlons de votre futur site web ou d’un projet similaire.</h2>
            <p>
                Que vous ayez besoin d’un site web, d’une identité visuelle simple ou d’une automatisation utile,
                je peux vous aider à construire une solution claire et adaptée à votre activité.
            </p>
            <a href="contact.php" class="btn btn-primary">
                <span class="button-outer"><span class="button-inner"><span class="button-text">Demander un devis</span></span></span>
            </a>
        </div>
    </section>
</main>

<?php include('includes/footer.php'); ?>
