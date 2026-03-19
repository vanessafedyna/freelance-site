<?php
$page_title = 'Développeur freelance au Canada | Sites web, logos et chatbots | Freelance Dev Studio';
$page_description = 'Développeur freelance en création de site web, logo et chatbot pour petites entreprises au Canada. Solutions modernes, claires et orientées résultats.';
$page_keywords = 'développeur freelance Canada, création de site web, création de logo, chatbot, petites entreprises';
$page_path = 'index.php';

include __DIR__ . '/includes/header.php';
?>

<main class="landing-page">
    <section id="home" class="hero">
        <div class="container hero-layout">
            <div class="hero-content">
                <p class="hero-badge">Développeur web freelance</p>
                <h1>Développeur freelance pour créer votre site, votre logo et vos automatisations chatbot</h1>
                <p class="hero-subtitle">
                    J'accompagne les petites entreprises avec des solutions digitales sur mesure, modernes
                    et orientées résultats.
                </p>
                <div class="hero-actions">
                    <a href="#contact" class="btn btn-primary">
                        <span class="button-outer"><span class="button-inner"><span class="button-text">Demander un devis</span></span></span>
                    </a>
                    <a href="#services" class="btn btn-secondary">
                        <span class="button-outer"><span class="button-inner"><span class="button-text">Voir mes services</span></span></span>
                    </a>
                </div>
            </div>
            <aside class="hero-panel" aria-label="Aperçu des offres">
                <h2>Ce que je vous apporte</h2>
                <ul>
                    <li>Un site web professionnel qui inspire confiance</li>
                    <li>Une identité visuelle claire avec un logo impactant</li>
                    <li>Des chatbots qui automatisent vos échanges clients</li>
                </ul>
            </aside>
        </div>
    </section>

    <section id="services" class="section section-services">
        <div class="container">
            <h2 class="section-title">Mes services</h2>
            <p class="section-intro">
                Une offre complète pour renforcer votre présence en ligne et gagner du temps.
            </p>
            <div class="service-grid">
                <article class="service-card">
                    <h3>Création de site web</h3>
                    <p>
                        Sites vitrines et pages de conversion rapides, responsives et conçus pour transformer
                        vos visiteurs en prospects.
                    </p>
                </article>
                <article class="service-card">
                    <h3>Création de logo</h3>
                    <p>
                        Logos modernes et cohérents avec votre image de marque pour vous démarquer
                        immédiatement.
                    </p>
                </article>
                <article class="service-card">
                    <h3>Chatbots &amp; automatisation</h3>
                    <p>
                        Chatbots personnalisés pour répondre automatiquement, qualifier vos leads et fluidifier
                        votre support client.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section id="portfolio" class="section section-portfolio">
        <div class="container">
            <h2 class="section-title">Résultats concrets</h2>
            <p class="section-intro">
                Chaque projet est pensé pour améliorer votre image, votre visibilité et votre efficacité commerciale.
            </p>
            <div class="portfolio-points">
                <p>Livraison claire, design soigné et performance optimisée.</p>
            </div>
        </div>
    </section>

    <section id="about" class="section section-why">
        <div class="container">
            <h2 class="section-title">Pourquoi me choisir</h2>
            <p class="section-intro">
                Un partenaire fiable pour construire une présence digitale durable.
            </p>
            <div class="why-grid">
                <article class="why-card">
                    <h3>Solutions sur mesure</h3>
                    <p>Chaque projet est adapté à vos objectifs, votre activité et votre budget.</p>
                </article>
                <article class="why-card">
                    <h3>Design moderne</h3>
                    <p>Une direction visuelle propre et professionnelle pour renforcer votre crédibilité.</p>
                </article>
                <article class="why-card">
                    <h3>Responsive mobile</h3>
                    <p>Une expérience fluide sur smartphone, tablette et desktop.</p>
                </article>
                <article class="why-card">
                    <h3>Accompagnement professionnel</h3>
                    <p>Suivi structuré, communication claire et conseils pratiques à chaque étape.</p>
                </article>
            </div>
        </div>
    </section>

    <section id="contact" class="section section-cta">
        <div class="container cta-box">
            <h2>Prêt à lancer votre projet digital ?</h2>
            <p>
                Discutons de vos objectifs et construisons une solution web, branding ou chatbot
                réellement utile pour votre activité.
            </p>
            <a href="mailto:you@example.com" class="btn btn-primary">
                <span class="button-outer"><span class="button-inner"><span class="button-text">Me contacter</span></span></span>
            </a>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

