<?php
declare(strict_types=1);

require_once __DIR__ . '/forms/contact-handler.php';

$formState = handle_contact_form($_SERVER['REQUEST_METHOD'] ?? 'GET', $_POST);
$projectOptions = contact_project_options();
$budgetOptions = contact_budget_options();

function contact_escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$page_title = 'Contact freelance | Demande de devis web au Canada | Freelance Dev Studio';
$page_description = 'Contactez votre développeur freelance pour une demande de devis : site web, logo ou chatbot pour votre projet au Canada.';
$page_keywords = 'contact freelance, demande de devis, projet web Canada, site web, logo, chatbot';
$page_path = 'contact.php';

include('includes/header.php');
?>

<main class="contact-page">
    <section class="section contact-hero">
        <div class="container">
            <p class="hero-badge">Contact freelance</p>
            <h1 class="contact-title">Parlons de votre projet digital</h1>
            <p class="contact-intro">
                Vous avez besoin d'un site web, d'un logo ou d'une solution de chatbot automatisée ?
                Décrivez votre besoin et je vous reviens avec une proposition claire.
            </p>
        </div>
    </section>

    <section class="section contact-content" id="contact-form">
        <div class="container contact-layout">
            <article class="contact-form-card">
                <h2>Envoyer une demande</h2>
                <p class="contact-note">Réponse sous 24 à 48 heures selon la demande.</p>

                <?php if ($formState['success'] !== ''): ?>
                    <div class="form-alert form-alert-success" role="status">
                        <?php echo contact_escape($formState['success']); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($formState['errors'])): ?>
                    <div class="form-alert form-alert-error" role="alert">
                        <p>Le formulaire contient des erreurs :</p>
                        <ul>
                            <?php foreach ($formState['errors'] as $error): ?>
                                <li><?php echo contact_escape($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form class="contact-form" method="post" action="contact.php" novalidate>
                    <div class="form-field">
                        <label for="nom">Nom</label>
                        <input
                            type="text"
                            id="nom"
                            name="nom"
                            value="<?php echo contact_escape($formState['values']['nom']); ?>"
                            autocomplete="name"
                            required
                            <?php echo isset($formState['errors']['nom']) ? 'aria-invalid="true"' : ''; ?>
                        >
                        <?php if (isset($formState['errors']['nom'])): ?>
                            <p class="field-error"><?php echo contact_escape($formState['errors']['nom']); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-field">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?php echo contact_escape($formState['values']['email']); ?>"
                            autocomplete="email"
                            required
                            <?php echo isset($formState['errors']['email']) ? 'aria-invalid="true"' : ''; ?>
                        >
                        <?php if (isset($formState['errors']['email'])): ?>
                            <p class="field-error"><?php echo contact_escape($formState['errors']['email']); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-field">
                        <label for="type_projet">Type de projet</label>
                        <select
                            id="type_projet"
                            name="type_projet"
                            required
                            <?php echo isset($formState['errors']['type_projet']) ? 'aria-invalid="true"' : ''; ?>
                        >
                            <option value="">Sélectionnez un type de projet</option>
                            <?php foreach ($projectOptions as $option): ?>
                                <option
                                    value="<?php echo contact_escape($option); ?>"
                                    <?php echo $formState['values']['type_projet'] === $option ? 'selected' : ''; ?>
                                >
                                    <?php echo contact_escape($option); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($formState['errors']['type_projet'])): ?>
                            <p class="field-error"><?php echo contact_escape($formState['errors']['type_projet']); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-field">
                        <label for="budget_estime">Budget estimé</label>
                        <select
                            id="budget_estime"
                            name="budget_estime"
                            required
                            <?php echo isset($formState['errors']['budget_estime']) ? 'aria-invalid="true"' : ''; ?>
                        >
                            <option value="">Sélectionnez un budget</option>
                            <?php foreach ($budgetOptions as $option): ?>
                                <option
                                    value="<?php echo contact_escape($option); ?>"
                                    <?php echo $formState['values']['budget_estime'] === $option ? 'selected' : ''; ?>
                                >
                                    <?php echo contact_escape($option); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($formState['errors']['budget_estime'])): ?>
                            <p class="field-error"><?php echo contact_escape($formState['errors']['budget_estime']); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-field">
                        <label for="message">Message</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            required
                            <?php echo isset($formState['errors']['message']) ? 'aria-invalid="true"' : ''; ?>
                        ><?php echo contact_escape($formState['values']['message']); ?></textarea>
                        <?php if (isset($formState['errors']['message'])): ?>
                            <p class="field-error"><?php echo contact_escape($formState['errors']['message']); ?></p>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary contact-submit">
                        <span class="button-outer"><span class="button-inner"><span class="button-text">Envoyer ma demande</span></span></span>
                    </button>
                </form>
            </article>

            <aside class="contact-side-card" aria-label="Informations de contact">
                <h2>Informations utiles</h2>
                <p>
                    Je travaille avec des indépendants, artisans et petites entreprises qui souhaitent
                    améliorer leur présence en ligne.
                </p>
                <ul class="contact-details">
                    <li><strong>Email :</strong> <a href="mailto:you@example.com">you@example.com</a></li>
                    <li><strong>Services :</strong> Sites web, logos, chatbots et automatisation</li>
                    <li><strong>Disponibilité :</strong> Lundi au vendredi</li>
                </ul>
                <p class="contact-side-note">
                    Chaque demande reçoit une réponse personnalisée avec une estimation claire des délais.
                </p>
            </aside>
        </div>
    </section>
</main>

<?php include('includes/footer.php'); ?>
