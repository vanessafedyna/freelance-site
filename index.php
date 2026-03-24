<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/session.php';
require_once __DIR__ . '/forms/testimonial-handler.php';

$featured_projects = [];
try {
    $pdo = get_db_connection();
    $stmt = $pdo->query(
        'SELECT title, slug, category, short_description, thumbnail, link_url
         FROM projects
         WHERE is_published = 1
         ORDER BY display_order ASC, created_at DESC
         LIMIT 3'
    );
    $featured_projects = $stmt->fetchAll();
} catch (Throwable $e) {
    $featured_projects = [];
}

// Témoignages approuvés
$testimonials = [];
$testimonial_count = 0;
try {
    $pdo = get_db_connection();
    $stmt = $pdo->query('SELECT name, job_title, message FROM testimonials WHERE is_approved = 1 ORDER BY created_at DESC');
    $testimonials = $stmt->fetchAll();

    $countStmt = $pdo->query('SELECT COUNT(*) FROM testimonials WHERE is_approved = 1');
    $testimonial_count = (int) $countStmt->fetchColumn();
} catch (Throwable $e) {
    $testimonials = [];
    $testimonial_count = 0;
}

$testimonialState = handle_testimonial_form($_SERVER['REQUEST_METHOD'] ?? 'GET', $_POST);
$testimonial_success = $testimonialState['success'];
$testimonial_error = $testimonialState['error'];
$testimonial_values = $testimonialState['values'];

$page_title = 'Développeur freelance au Canada | Interface web narrative et conversion | MONATECH';
$page_description = 'Je conçois à Montréal des expériences web narratives pour petites entreprises au Québec : site web, logo et automatisation chatbot orientés conversion.';
$page_path = 'index.php';

include __DIR__ . '/includes/header.php';
?>

<main class="narrative-home">
    <section id="home" class="story-hero">
        <div class="container">
            <div class="story-hero-grid">
                <div class="story-hero-copy">
                    <p class="story-kicker hero-enter hero-enter-d2">Création de site web pour petites entreprises</p>
                    <h1 class="hero-enter hero-enter-d3">Votre site devrait vous ramener des clients — pas juste vous représenter en ligne.</h1>
                    <p class="story-lead hero-enter hero-enter-d4">
                        Je conçois des sites web qui expliquent clairement votre offre, rassurent vos visiteurs et vous amènent plus de demandes qualifiées — sans vous imposer une solution générique.
                    </p>
                    <p class="hero-differentiator hero-enter hero-enter-d5">Développeuse web freelance à Montréal — formée en cybersécurité, spécialisée PME.</p>
                    <div class="story-actions hero-enter hero-enter-d5">
                        <a href="/contact.php" class="btn btn-primary">
                            <span class="button-outer"><span class="button-inner"><span class="button-text">Demander un devis gratuit</span></span></span>
                        </a>
                        <a href="#solution" class="btn btn-secondary">
                            <span class="button-outer"><span class="button-inner"><span class="button-text">Découvrir le parcours</span></span></span>
                        </a>
                    </div>
                </div>

                <aside class="story-hero-aside hero-enter hero-enter-d5" data-parallax data-speed="0.05" aria-label="Enjeux clients fréquents">
                    <div class="hero-photo-wrap">
                        <img
                            src="/assets/images/10032.png"
                            alt="Vanessa Fedyna, fondatrice de MONATECH Studio"
                            class="hero-photo"
                            width="480"
                            height="580"
                            loading="eager"
                        >
                        <p class="hero-photo-caption">Vanessa Fedyna — Fondatrice de MONATECH</p>
                    </div>
                    <p class="story-panel-title">Le constat terrain</p>
                    <ul>
                        <li>Un site qui informe, mais ne convainc pas.</li>
                        <li>Une image de marque qui manque de cohérence.</li>
                        <li>Des demandes clients répétitives qui ralentissent votre équipe.</li>
                    </ul>
                    <p class="story-panel-note">
                        Mon rôle : rendre votre présence en ligne plus claire, cohérente et efficace.
                    </p>
                </aside>
            </div>

            <div class="story-scroll-indicator" data-reveal>
                <span aria-hidden="true"></span>
                <p>Faire défiler pour suivre le parcours</p>
            </div>
        </div>
    </section>

    <section id="probleme" class="story-problem">
        <div class="container">
            <div class="story-section-head" data-reveal>
                <h2>Vous investissez en ligne, mais le message reste flou.</h2>
            </div>

            <div class="problem-layout">
                <article class="problem-editorial" data-reveal>
                    <p>
                        Votre entreprise a peut-être déjà un site en ligne.
                        Mais si votre offre est mal expliquée, vos visiteurs hésitent et quittent sans vous contacter.
                    </p>
                    <p>
                        Résultat : vous perdez des opportunités, vous répétez souvent les mêmes explications,
                        et votre présence en ligne ne soutient pas vraiment votre développement.
                    </p>
                </article>

                <aside class="problem-frictions" data-reveal aria-label="Points de friction">
                    <h3>Signaux d'alerte</h3>
                    <ol>
                        <li>Votre site ne génère pas assez de demandes.</li>
                        <li>Votre offre n’est pas comprise rapidement.</li>
                        <li>Vous perdez du temps à répondre toujours aux mêmes questions.</li>
                    </ol>
                </aside>
            </div>
        </div>
    </section>

    <section id="transformation" class="story-transformation">
        <div class="container">
            <div class="story-section-head" data-reveal>
                <h2>Passer d'une présence dispersée à une expérience qui guide naturellement.</h2>
            </div>

            <div class="transformation-track">
                <article class="transformation-state before" data-reveal>
                    <p class="state-label">Avant</p>
                    <ul>
                        <li>Offre difficile à comprendre</li>
                        <li>Site peu rassurant</li>
                        <li>Trop de réponses à refaire à la main</li>
                    </ul>
                </article>

                <article class="transformation-state after" data-reveal>
                    <p class="state-label">Après</p>
                    <ul>
                        <li>Offre plus claire dès les premières secondes</li>
                        <li>Site plus professionnel et rassurant</li>
                        <li>Suivi plus fluide au quotidien</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section id="solution" class="story-solution">
        <div class="container">
            <div class="story-section-head" data-reveal>
                <h2>Une base claire : votre site web, puis les bons compléments.</h2>
            </div>

            <div class="systems-flow">
                <article class="system-block" data-reveal>
                    <p class="system-index">Système 01</p>
                    <h3>Création de site web</h3>
                    <p>
                        Un site clair, rapide et professionnel pour présenter votre offre, rassurer vos visiteurs et générer plus de demandes.
                    </p>
                    <ul>
                        <li>Structure pensée pour la prise de contact</li>
                        <li>Pages essentielles : accueil, offre, contact</li>
                        <li>Version responsive et rapide</li>
                    </ul>
                </article>

                <article class="system-block" data-reveal>
                    <p class="system-index">Système 02</p>
                    <h3>Identité visuelle essentielle</h3>
                    <p>
                        Une identité visuelle essentielle et cohérente pour renforcer l’image de votre entreprise.
                    </p>
                    <ul>
                        <li>Logo clair et lisible</li>
                        <li>Palette et repères visuels</li>
                        <li>Cohérence entre site et supports</li>
                    </ul>
                </article>

                <article class="system-block" data-reveal>
                    <p class="system-index">Système 03</p>
                    <h3>Automatisations efficaces</h3>
                    <p>
                        Des automatisations utiles pour gagner du temps sur les demandes récurrentes et améliorer le suivi.
                    </p>
                    <ul>
                        <li>Réponses automatiques de base</li>
                        <li>Préqualification des demandes</li>
                        <li>Orientation vers le bon canal</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section id="resultats" class="story-results">
        <div class="container results-layout">
            <div class="results-copy" data-reveal>
                <h2>Des bénéfices visibles pour votre activité, pas juste un beau design.</h2>
                <p>
                    L’objectif n’est pas seulement d’avoir un site plus joli, mais un site plus utile :
                    mieux expliquer votre offre, faciliter la prise de contact et vous faire gagner du temps.
                </p>
            </div>

            <div class="results-board">
                <article class="result-item" data-reveal>
                    <h3>Une offre mieux comprise</h3>
                    <p>Vos visiteurs comprennent plus vite ce que vous proposez et à qui vous vous adressez.</p>
                </article>
                <article class="result-item" data-reveal>
                    <h3>Davantage de demandes utiles</h3>
                    <p>Le site aide vos visiteurs à passer à l’action plus facilement et améliore la qualité des prises de contact.</p>
                </article>
                <article class="result-item" data-reveal>
                    <h3>Moins de tâches répétitives</h3>
                    <p>Des réponses mieux préparées et des automatisations efficaces réduisent le temps passé sur les demandes récurrentes.</p>
                </article>
            </div>
        </div>
    </section>

    <?php if (!empty($featured_projects)): ?>
    <section class="section featured-work">
        <div class="container">
            <div class="featured-work-head" data-reveal>
                <div>
                    <p class="story-step">Réalisations</p>
                    <h2>Quelques projets récents.</h2>
                </div>
                <a href="/portfolio.php" class="featured-work-link">Voir tout le portfolio →</a>
            </div>

            <div class="featured-grid">
                <?php foreach ($featured_projects as $fp):
                    $fpThumb = trim((string) ($fp['thumbnail'] ?? ''));
                    $fpHasImage = $fpThumb !== '' && (bool) preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $fpThumb);
                    $fpTitle = htmlspecialchars(trim((string) ($fp['title'] ?? '')), ENT_QUOTES, 'UTF-8');
                    $fpCategory = htmlspecialchars(trim((string) ($fp['category'] ?? '')), ENT_QUOTES, 'UTF-8');
                    $fpDesc = htmlspecialchars(trim((string) ($fp['short_description'] ?? '')), ENT_QUOTES, 'UTF-8');
                    $fpLink = trim((string) ($fp['link_url'] ?? '')) ?: '/portfolio.php';
                ?>
                <article class="featured-card ui-card project-hover-card" data-reveal>
                    <div class="featured-card-thumb project-hover-media">
                        <?php if ($fpHasImage): ?>
                            <img src="<?php echo htmlspecialchars($fpThumb, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo $fpTitle; ?>" loading="lazy">
                        <?php else: ?>
                            <span class="featured-card-placeholder"><?php echo $fpCategory ?: 'Projet'; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="featured-card-body">
                        <p class="featured-card-category"><?php echo $fpCategory; ?></p>
                        <h3><?php echo $fpTitle; ?></h3>
                        <p><?php echo $fpDesc; ?></p>
                        <a href="<?php echo htmlspecialchars($fpLink, ENT_QUOTES, 'UTF-8'); ?>" class="featured-card-cta project-hover-link">Voir le projet →</a>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($testimonial_count >= 2): ?>
        <section id="testimonials" class="section testimonials-section">
            <div class="container">
                <div class="testimonials-head" data-reveal>
                    <p class="story-step">Témoignages</p>
                    <h2>Ce que disent les clients.</h2>
                </div>

                <div class="testimonials-layout">
                    <div class="testimonials-stage">
                        <div class="testimonials-editorial" data-reveal>
                            <p>Des retours concrets sur la clarté, la qualité du rendu et la fluidité du travail mené ensemble.</p>
                        </div>

                        <?php if (!empty($testimonials)): ?>
                            <div class="testimonials-grid">
                                <?php foreach ($testimonials as $t): ?>
                                    <article class="testimonial-card" data-reveal>
                                        <div class="testimonial-avatar"></div>
                                        <div class="testimonial-body">
                                            <p class="testimonial-quote">"<?php echo htmlspecialchars((string)$t['message'], ENT_QUOTES, 'UTF-8'); ?>"</p>
                                            <p class="testimonial-author">
                                                — <?php echo htmlspecialchars((string)$t['name'], ENT_QUOTES, 'UTF-8'); ?>
                                                <?php if (!empty($t['job_title'])): ?>
                                                    <span class="testimonial-job">, <?php echo htmlspecialchars((string)$t['job_title'], ENT_QUOTES, 'UTF-8'); ?></span>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="testimonials-empty" data-reveal>Les premiers avis arrivent bientôt.</p>
                        <?php endif; ?>
                    </div>

                    <div class="testimonial-form-wrap" data-reveal>
                        <h3>Vous avez travaillé avec moi ?</h3>
                        <p>Partagez votre expérience — votre avis sera publié après vérification.</p>

                        <?php if ($testimonial_success): ?>
                            <div class="testimonial-alert testimonial-alert-success">
                                Merci pour votre avis ! Il sera visible après validation.
                            </div>
                        <?php elseif ($testimonial_error !== ''): ?>
                            <div class="testimonial-alert testimonial-alert-error">
                                <?php echo htmlspecialchars($testimonial_error, ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!$testimonial_success): ?>
                            <form class="testimonial-form" method="post" action="#testimonials" novalidate>
                                <input type="hidden" name="testimonial_submit" value="1">
                                <div class="testimonial-form-row">
                                    <div class="testimonial-field">
                                        <label for="t_name">Votre nom *</label>
                                        <input type="text" id="t_name" name="t_name" maxlength="100" required
                                            value="<?php echo htmlspecialchars($testimonial_values['t_name'], ENT_QUOTES, 'UTF-8'); ?>">
                                    </div>
                                    <div class="testimonial-field">
                                        <label for="t_title">Poste ou entreprise</label>
                                        <input type="text" id="t_title" name="t_title" maxlength="150"
                                            value="<?php echo htmlspecialchars($testimonial_values['t_title'], ENT_QUOTES, 'UTF-8'); ?>">
                                    </div>
                                </div>
                                <div class="testimonial-field">
                                    <label for="t_message">Votre avis *</label>
                                    <textarea id="t_message" name="t_message" rows="4" maxlength="1000" required><?php echo htmlspecialchars($testimonial_values['t_message'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>
                                <div class="testimonial-field">
                                    <label>
                                        <input
                                            type="checkbox"
                                            name="consent"
                                            value="1"
                                            required
                                            <?php echo $testimonial_values['consent'] === '1' ? 'checked' : ''; ?>
                                        >
                                        En soumettant ce formulaire, j'accepte que mes données soient traitées conformément à la
                                        <a href="/politique-confidentialite.php" target="_blank">politique de confidentialité</a>.
                                    </label>
                                </div>
                                <?php echo csrf_input(); ?>
                                <button type="submit" class="btn btn-primary">
                                    <span class="button-outer"><span class="button-inner"><span class="button-text">Envoyer mon avis</span></span></span>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <section class="section-engagement">
            <div class="container">
                <h2>Mon engagement</h2>
                <div class="engagement-grid">
                    <div class="engagement-card">
                        <h3>Un seul interlocuteur</h3>
                        <p>Du premier échange à la mise en ligne, vous travaillez directement avec moi — pas un intermédiaire.</p>
                    </div>
                    <div class="engagement-card">
                        <h3>Transparence totale</h3>
                        <p>Devis détaillé avant de commencer, suivi régulier et aucune surprise sur la facture finale.</p>
                    </div>
                    <div class="engagement-card">
                        <h3>Réponse sous 48h</h3>
                        <p>Chaque demande de devis reçoit une proposition claire en 48 heures maximum.</p>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section id="contact" class="story-final-cta">
        <div class="container">
            <div class="story-cta-box" data-reveal>
                <h2>Parlons de votre site web et de ce qu’il peut vraiment apporter à votre entreprise.</h2>
                <p>Décrivez votre activité en quelques lignes — je vous réponds avec une proposition claire sous 48h.</p>
                <a href="/contact.php" class="btn btn-primary">
                    <span class="button-outer"><span class="button-inner"><span class="button-text">Demander un devis gratuit</span></span></span>
                </a>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
