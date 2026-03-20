<?php
declare(strict_types=1);

$page_title = 'Developpeur freelance au Canada | Site web performant | Freelance Dev Studio';
$page_description = 'Je concois des sites web professionnels pour petites entreprises : creation, refonte, optimisation et accompagnement.';
$page_path = 'index.php';

$contact_form_data = [
    'name' => '',
    'email' => '',
    'subject' => '',
    'message' => '',
];
$contact_feedback = '';
$contact_feedback_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form']) && trim((string)($_POST['website'] ?? '')) === '') {
    $contact_form_data['name'] = trim((string)($_POST['name'] ?? ''));
    $contact_form_data['email'] = trim((string)($_POST['email'] ?? ''));
    $contact_form_data['subject'] = trim((string)($_POST['subject'] ?? ''));
    $contact_form_data['message'] = trim((string)($_POST['message'] ?? ''));

    $safe_name = preg_replace('/[\r\n]+/', ' ', $contact_form_data['name']) ?? '';
    $safe_email = filter_var($contact_form_data['email'], FILTER_SANITIZE_EMAIL) ?: '';
    $safe_subject = preg_replace('/[\r\n]+/', ' ', $contact_form_data['subject']) ?? '';
    $safe_message = str_replace("\0", '', $contact_form_data['message']);

    $all_fields_filled = $safe_name !== '' && $safe_email !== '' && $safe_subject !== '' && $safe_message !== '';
    $email_is_valid = filter_var($safe_email, FILTER_VALIDATE_EMAIL) !== false;

    if (!$all_fields_filled) {
        $contact_feedback = 'Veuillez remplir tous les champs.';
        $contact_feedback_type = 'error';
    } elseif (!$email_is_valid) {
        $contact_feedback = 'Veuillez entrer une adresse email valide.';
        $contact_feedback_type = 'error';
    } else {
        $to = 'votre.email@exemple.com';
        $mail_subject = 'Nouveau message contact : ' . $safe_subject;
        $mail_body = "Nom: {$safe_name}\n";
        $mail_body .= "Email: {$safe_email}\n";
        $mail_body .= "Sujet: {$safe_subject}\n\n";
        $mail_body .= "Message:\n{$safe_message}\n";

        $headers = "From: Site Freelance <contact@tonsite.com>\r\n";
        $headers .= "Reply-To: {$safe_email}\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (mail($to, $mail_subject, $mail_body, $headers)) {
            $contact_feedback = 'Votre message a ete envoye avec succes.';
            $contact_feedback_type = 'success';
            $contact_form_data = [
                'name' => '',
                'email' => '',
                'subject' => '',
                'message' => '',
            ];
        } else {
            $contact_feedback = 'Une erreur est survenue lors de l envoi. Merci de reessayer.';
            $contact_feedback_type = 'error';
        }
    }
}

include __DIR__ . '/includes/header.php';
?>

<main class="home-page">
    <section id="hero" class="section home-hero">
        <div class="container">
            <p class="home-hero-intro">Developpeuse freelance</p>
            <h1>Un site web clair et performant pour attirer plus de clients.</h1>
            <p class="home-hero-text">
                Je conçois des sites professionnels pour independants et petites entreprises, avec un objectif simple: convertir plus de visiteurs en demandes concretes.
            </p>
            <div class="home-hero-actions">
                <a href="#contact" class="home-btn home-btn-primary">Demander un devis</a>
                <a href="#services" class="home-btn home-btn-secondary">Voir mes services</a>
            </div>
        </div>
    </section>

    <section id="services" class="section home-services">
        <div class="container">
            <h2 class="section-title">Services</h2>
            <p class="section-intro">Des solutions web simples, efficaces et adaptees a vos objectifs.</p>
            <div class="home-grid home-grid-3">
                <article class="home-card">
                    <h3>Creation de site web</h3>
                    <p>Site vitrine ou site professionnel sur mesure, rapide, responsive et oriente conversion.</p>
                </article>
                <article class="home-card">
                    <h3>Refonte de site</h3>
                    <p>Modernisation de votre site actuel pour ameliorer votre image, votre message et vos resultats.</p>
                </article>
                <article class="home-card">
                    <h3>Optimisation performance &amp; SEO</h3>
                    <p>Amelioration de la vitesse, de la structure technique et des bases SEO pour gagner en visibilite.</p>
                </article>
            </div>
        </div>
    </section>

    <?php
    require_once __DIR__ . '/config/database.php';

    $projects = [];
    $projects_connection_failed = false;

    $pdo = getDatabaseConnection();
    if ($pdo === null) {
        $projects_connection_failed = true;
    } else {
        try {
            $stmt = $pdo->query('SELECT * FROM projects ORDER BY id DESC');
            $projects = $stmt->fetchAll();
        } catch (Throwable $exception) {
            $projects_connection_failed = true;
        }
    }
    ?>
    <section id="portfolio" class="section home-portfolio">
        <div class="container">
            <h2 class="section-title">Portfolio</h2>
            <p class="section-intro">Quelques projets recents realises pour des entreprises et independants.</p>

            <?php if ($projects_connection_failed): ?>
                <p class="home-feedback">Impossible de charger les projets pour le moment.</p>
            <?php elseif (empty($projects)): ?>
                <p class="home-feedback">Les projets seront ajoutes prochainement.</p>
            <?php else: ?>
                <div class="home-grid home-grid-3">
                    <?php foreach ($projects as $project): ?>
                        <article class="home-card">
                            <h3><?= htmlspecialchars((string)($project['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?></h3>
                            <p><?= htmlspecialchars((string)($project['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?></p>
                            <p class="home-tech"><?= htmlspecialchars((string)($project['technologies'] ?? ''), ENT_QUOTES, 'UTF-8') ?></p>
                            <a href="<?= htmlspecialchars((string)($project['project_url'] ?? '#'), ENT_QUOTES, 'UTF-8') ?>" class="home-link" target="_blank" rel="noopener noreferrer">Voir le projet</a>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section id="about" class="section home-about">
        <div class="container">
            <h2 class="section-title">A propos</h2>
            <p class="section-intro">Je travaille avec des entrepreneurs qui veulent un site utile, fiable et rentable.</p>
            <div class="home-grid home-grid-2">
                <div class="home-card">
                    <p>
                        Je suis developpeuse freelance, specialisee dans la creation et l'amelioration de sites web pour petites entreprises.
                        Mon approche est simple: clarifier votre offre, faciliter la prise de contact et renforcer votre credibilite en ligne.
                    </p>
                </div>
                <div class="home-card">
                    <h3>Points forts</h3>
                    <ul class="home-list">
                        <li>Sites rapides et optimises</li>
                        <li>Design clair et moderne</li>
                        <li>Accompagnement personnalise</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="section home-contact">
        <div class="container">
            <h2 class="section-title">Contact</h2>
            <p class="section-intro">Parlez-moi de votre projet, je vous reponds rapidement avec une proposition claire.</p>

            <?php if ($contact_feedback !== ''): ?>
                <p class="contact-home-feedback <?= $contact_feedback_type === 'success' ? 'is-success' : 'is-error' ?>">
                    <?= htmlspecialchars($contact_feedback, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>

            <form class="contact-home-form" action="#" method="post">
                <input type="hidden" name="contact_form" value="1">
                <input type="text" name="website" class="contact-honeypot" tabindex="-1" autocomplete="off">
                <div class="contact-home-grid">
                    <div class="contact-home-field">
                        <label for="contact-name">Nom</label>
                        <input type="text" id="contact-name" name="name" value="<?= htmlspecialchars($contact_form_data['name'], ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                    <div class="contact-home-field">
                        <label for="contact-email">Email</label>
                        <input type="email" id="contact-email" name="email" value="<?= htmlspecialchars($contact_form_data['email'], ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                </div>

                <div class="contact-home-field">
                    <label for="contact-subject">Sujet</label>
                    <input type="text" id="contact-subject" name="subject" value="<?= htmlspecialchars($contact_form_data['subject'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="contact-home-field">
                    <label for="contact-message">Message</label>
                    <textarea id="contact-message" name="message" rows="6" required><?= htmlspecialchars($contact_form_data['message'], ENT_QUOTES, 'UTF-8') ?></textarea>
                </div>

                <button type="submit" class="contact-home-submit">Envoyer</button>
            </form>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
