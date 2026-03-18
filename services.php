<?php
declare(strict_types=1);

$page_title = 'Services web freelance | Sites, logos et automatisation | Freelance Dev Studio';
$page_description = 'Services web freelance pour petites entreprises au Canada : création de site web, création de logo et chatbots avec automatisation simple.';
$page_keywords = 'services web freelance, création de site web, création de logo, automatisation, Canada';
$page_path = 'services.php';

include('includes/header.php');
?>

<main class="services-page">
    <section class="section services-hero">
        <div class="container services-hero-inner">
            <p class="hero-badge">Prestations freelance</p>
            <h1>Mes services</h1>
            <p class="services-intro">
                J'accompagne les petites entreprises pour renforcer leur présence en ligne,
                clarifier leur image de marque et automatiser les échanges clients.
            </p>
            <a href="contact.php" class="btn btn-primary">Demander un devis</a>
        </div>
    </section>

    <section class="section services-main">
        <div class="container">
            <div class="service-offer-grid">
                <article class="service-offer-card">
                    <h2>Création de site web</h2>
                    <p class="offer-intro">
                        Une présence web professionnelle, rapide et claire pour présenter votre activité.
                    </p>
                    <ul class="offer-list">
                        <li>Site vitrine</li>
                        <li>Site professionnel responsive</li>
                        <li>Page d'accueil + pages internes</li>
                        <li>Formulaire de contact</li>
                        <li>Design moderne</li>
                    </ul>
                    <p class="offer-benefit">
                        Bénéfice client : vous gagnez en crédibilité et facilitez la prise de contact.
                    </p>
                    <a href="contact.php" class="btn btn-secondary">Demander ce service</a>
                </article>

                <article class="service-offer-card">
                    <h2>Création de logo</h2>
                    <p class="offer-intro">
                        Une identité visuelle simple et impactante pour vous différencier rapidement.
                    </p>
                    <ul class="offer-list">
                        <li>Logo professionnel</li>
                        <li>Identité visuelle simple</li>
                        <li>Palette de couleurs</li>
                        <li>Déclinaisons pour web / réseaux sociaux</li>
                    </ul>
                    <p class="offer-benefit">
                        Bénéfice client : une image claire, cohérente et mémorable sur tous vos supports.
                    </p>
                    <a href="contact.php" class="btn btn-secondary">Demander ce service</a>
                </article>

                <article class="service-offer-card">
                    <h2>Chatbots &amp; automatisation</h2>
                    <p class="offer-intro">
                        Des automatismes utiles pour répondre plus vite et réduire les tâches répétitives.
                    </p>
                    <ul class="offer-list">
                        <li>Chatbot FAQ</li>
                        <li>Assistant de contact</li>
                        <li>Automatisation simple</li>
                        <li>Solution adaptée aux petites entreprises</li>
                    </ul>
                    <p class="offer-benefit">
                        Bénéfice client : vous optimisez votre temps tout en améliorant l'expérience client.
                    </p>
                    <a href="contact.php" class="btn btn-secondary">Demander ce service</a>
                </article>
            </div>
        </div>
    </section>

    <section class="section services-process">
        <div class="container">
            <h2 class="section-title">Ma méthode de travail</h2>
            <p class="section-intro">
                Un processus clair pour avancer efficacement, avec un suivi professionnel à chaque étape.
            </p>
            <div class="process-grid">
                <article class="process-card">
                    <p class="process-step">Étape 1</p>
                    <h3>Analyse du besoin</h3>
                    <p>Nous clarifions vos objectifs, vos priorités et votre cible.</p>
                </article>
                <article class="process-card">
                    <p class="process-step">Étape 2</p>
                    <h3>Proposition adaptée</h3>
                    <p>Je vous propose une solution concrète avec périmètre, délais et budget.</p>
                </article>
                <article class="process-card">
                    <p class="process-step">Étape 3</p>
                    <h3>Conception / développement</h3>
                    <p>Je réalise le projet avec des points d'étape pour garder une vision commune.</p>
                </article>
                <article class="process-card">
                    <p class="process-step">Étape 4</p>
                    <h3>Livraison et ajustements</h3>
                    <p>Vous recevez une version finalisée avec ajustements de finition si nécessaire.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section services-final-cta">
        <div class="container cta-box services-cta-box">
            <h2>Un projet en tête ?</h2>
            <p>
                Parlons de vos besoins et recevez une proposition claire adaptée à votre activité.
            </p>
            <a href="contact.php" class="btn btn-primary">Me contacter</a>
        </div>
    </section>
</main>

<?php include('includes/footer.php'); ?>