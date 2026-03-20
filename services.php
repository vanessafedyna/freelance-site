<?php
declare(strict_types=1);

$page_title = 'Services web freelance | Sites, logos et automatisation | MONATECH';
$page_description = 'Services web freelance pour petites entreprises au Canada : création de site web, création de logo et chatbots avec automatisation simple.';
$page_keywords = 'services web freelance, création de site web, création de logo, automatisation, Canada';
$page_path = 'services.php';

include('includes/header.php');
?>

<main class="services-page">
    <section class="section services-hero">
        <div class="container services-hero-inner">
            <p class="hero-badge">Services pour petites entreprises</p>
            <h1>Des services web clairs pour développer votre présence en ligne.</h1>
            <p class="services-intro">
                Je propose en priorité la création de site web, avec des compléments utiles comme une identité visuelle simple et des automatisations adaptées à votre activité.
            </p>
            <a href="contact.php" class="btn btn-primary">
                <span class="button-outer"><span class="button-inner"><span class="button-text">Demander un devis</span></span></span>
            </a>
        </div>
    </section>

    <section class="section services-main">
        <div class="container">
            <div class="service-offer-grid">
                <article class="service-offer-card">
                    <h2>Création de site web</h2>
                    <p class="offer-intro">
                        Un site clair, professionnel et pensé pour présenter votre offre, rassurer vos visiteurs et faciliter la prise de contact.
                    </p>
                    <ul class="offer-list">
                        <li>Site vitrine pour petite entreprise</li>
                        <li>Structure claire et responsive</li>
                        <li>Pages essentielles : accueil, offre, contact</li>
                        <li>Formulaire de contact</li>
                        <li>Base propre, rapide et professionnelle</li>
                    </ul>
                    <p class="offer-benefit">
                        Bénéfice client : vous présentez mieux votre activité et facilitez les demandes de contact.
                    </p>
                    <a href="contact.php" class="btn btn-secondary">
                        <span class="button-outer"><span class="button-inner"><span class="button-text">Demander ce service</span></span></span>
                    </a>
                </article>

                <article class="service-offer-card">
                    <h2>Identité visuelle simple</h2>
                    <p class="offer-intro">
                        Une base visuelle simple et cohérente pour renforcer l’image de votre entreprise sur le web.
                    </p>
                    <ul class="offer-list">
                        <li>Logo simple et lisible</li>
                        <li>Palette de couleurs</li>
                        <li>Repères visuels de base</li>
                        <li>Cohérence entre site et supports</li>
                    </ul>
                    <p class="offer-benefit">
                        Bénéfice client : votre image devient plus claire, plus cohérente et plus professionnelle.
                    </p>
                    <a href="contact.php" class="btn btn-secondary">
                        <span class="button-outer"><span class="button-inner"><span class="button-text">Demander ce service</span></span></span>
                    </a>
                </article>

                <article class="service-offer-card">
                    <h2>Automatisations simples</h2>
                    <p class="offer-intro">
                        Des automatisations utiles pour gagner du temps sur les demandes récurrentes et améliorer le suivi.
                    </p>
                    <ul class="offer-list">
                        <li>Réponses automatiques de base</li>
                        <li>Préqualification des demandes</li>
                        <li>Orientation vers le bon canal</li>
                        <li>Solution adaptée aux petites entreprises</li>
                    </ul>
                    <p class="offer-benefit">
                        Bénéfice client : vous réduisez les tâches répétitives et améliorez la gestion des demandes.
                    </p>
                    <a href="contact.php" class="btn btn-secondary">
                        <span class="button-outer"><span class="button-inner"><span class="button-text">Demander ce service</span></span></span>
                    </a>
                </article>
            </div>
        </div>
    </section>

    <section class="section services-process">
        <div class="container">
            <h2 class="section-title">Ma méthode de travail</h2>
            <p class="section-intro">
                Une méthode simple pour cadrer le projet, avancer clairement et livrer un site utile à votre activité.
            </p>
            <div class="process-grid">
                <article class="process-card">
                    <p class="process-step">Étape 1</p>
                    <h3>Analyse du besoin</h3>
                    <p>Nous clarifions vos besoins, vos priorités et ce que votre site doit apporter à votre activité.</p>
                </article>
                <article class="process-card">
                    <p class="process-step">Étape 2</p>
                    <h3>Proposition adaptée</h3>
                    <p>Je vous propose une solution claire avec un périmètre, un délai et un budget adaptés.</p>
                </article>
                <article class="process-card">
                    <p class="process-step">Étape 3</p>
                    <h3>Conception / développement</h3>
                    <p>Je conçois et développe le projet avec des points réguliers pour avancer de façon claire.</p>
                </article>
                <article class="process-card">
                    <p class="process-step">Étape 4</p>
                    <h3>Livraison et ajustements</h3>
                    <p>Vous recevez une version finalisée, avec les derniers ajustements nécessaires avant mise en ligne.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section services-final-cta">
        <div class="container cta-box services-cta-box">
            <h2>Parlons du site web dont votre entreprise a besoin.</h2>
            <p>
                Je peux vous aider à définir une solution claire, adaptée à votre activité et à vos priorités.
            </p>
            <a href="contact.php" class="btn btn-primary">
                <span class="button-outer"><span class="button-inner"><span class="button-text">Me contacter</span></span></span>
            </a>
        </div>
    </section>
</main>

<?php include('includes/footer.php'); ?>
