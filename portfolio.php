<?php
declare(strict_types=1);

$page_title = 'Portfolio freelance | Projets web, branding et chatbot | Freelance Dev Studio';
$page_description = 'Portfolio freelance de projets web, branding et chatbot pour petites entreprises au Canada. Exemples de réalisations orientées résultats.';
$page_keywords = 'portfolio freelance, projets web, branding, chatbot, Canada';
$page_path = 'portfolio.php';

include('includes/header.php');
?>

<main class="portfolio-page">
    <section class="section portfolio-hero">
        <div class="container portfolio-hero-inner">
            <p class="hero-badge">Réalisations freelance</p>
            <h1>Mon portfolio</h1>
            <p class="portfolio-intro">
                Ces projets reflètent mon approche en web design, branding et solutions digitales
                pour les petites entreprises au Canada.
            </p>
            <a href="contact.php" class="btn btn-primary">Demander un devis</a>
        </div>
    </section>

    <section class="section portfolio-filter-section">
        <div class="container">
            <div class="portfolio-filters" aria-label="Filtrer les projets">
                <button type="button" class="filter-chip is-active">Tous</button>
                <button type="button" class="filter-chip">Sites web</button>
                <button type="button" class="filter-chip">Logos</button>
                <button type="button" class="filter-chip">Chatbots</button>
            </div>
        </div>
    </section>

    <section class="section portfolio-grid-section">
        <div class="container">
            <div class="portfolio-grid">
                <article class="project-card">
                    <div class="project-thumb">Mockup</div>
                    <p class="project-category">Site web</p>
                    <h2>Site vitrine pour restaurant</h2>
                    <p>Conception d'un site clair avec menu, horaires, réservations et mise en avant des avis clients.</p>
                    <p class="project-result">Résultat : plus de demandes de réservation en ligne.</p>
                    <a href="contact.php" class="project-link">Voir le projet</a>
                </article>

                <article class="project-card">
                    <div class="project-thumb">Mockup</div>
                    <p class="project-category">Site web</p>
                    <h2>Site web pour coach sportif</h2>
                    <p>Site professionnel responsive avec présentation des offres, témoignages et formulaire d'inscription.</p>
                    <p class="project-result">Résultat : meilleure conversion des visites en prises de rendez-vous.</p>
                    <a href="contact.php" class="project-link">Voir le projet</a>
                </article>

                <article class="project-card">
                    <div class="project-thumb">Logo</div>
                    <p class="project-category">Logo</p>
                    <h2>Logo pour boutique locale</h2>
                    <p>Création d'un logo professionnel et d'une direction visuelle simple pour les supports print et web.</p>
                    <p class="project-result">Résultat : image de marque plus reconnaissable en magasin et en ligne.</p>
                    <a href="contact.php" class="project-link">Voir le projet</a>
                </article>

                <article class="project-card">
                    <div class="project-thumb">Landing</div>
                    <p class="project-category">Site web</p>
                    <h2>Landing page pour salon de beauté</h2>
                    <p>Page de conversion axée sur les prestations, les promotions saisonnières et la prise de contact rapide.</p>
                    <p class="project-result">Résultat : hausse des demandes sur mobile et des appels entrants.</p>
                    <a href="contact.php" class="project-link">Voir le projet</a>
                </article>

                <article class="project-card">
                    <div class="project-thumb">Chatbot</div>
                    <p class="project-category">Chatbot</p>
                    <h2>Chatbot FAQ pour commerce</h2>
                    <p>Assistant conversationnel pour répondre aux questions fréquentes sur les produits et la livraison.</p>
                    <p class="project-result">Résultat : moins de demandes répétitives et service client plus fluide.</p>
                    <a href="contact.php" class="project-link">Voir le projet</a>
                </article>

                <article class="project-card">
                    <div class="project-thumb">Branding</div>
                    <p class="project-category">Branding</p>
                    <h2>Identité visuelle pour petite entreprise</h2>
                    <p>Mise en place d'une identité cohérente : logo, palette, typographies et règles d'usage principales.</p>
                    <p class="project-result">Résultat : communication plus uniforme sur le web et les réseaux sociaux.</p>
                    <a href="contact.php" class="project-link">Voir le projet</a>
                </article>
            </div>
        </div>
    </section>

    <section class="section portfolio-values">
        <div class="container">
            <h2 class="section-title">Une approche orientée résultats</h2>
            <div class="portfolio-values-grid">
                <article class="value-card">
                    <h3>Approche sur mesure</h3>
                    <p>Chaque projet est construit selon vos objectifs commerciaux et votre réalité terrain.</p>
                </article>
                <article class="value-card">
                    <h3>Design professionnel</h3>
                    <p>Des interfaces modernes et claires pour renforcer votre crédibilité dès la première visite.</p>
                </article>
                <article class="value-card">
                    <h3>Solutions adaptées aux petites entreprises</h3>
                    <p>Des choix pragmatiques, simples à maintenir et alignés avec votre budget.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section portfolio-final-cta">
        <div class="container cta-box portfolio-cta-box">
            <h2>Discutons de votre prochain projet</h2>
            <p>
                Que vous ayez besoin d'un site web, d'un logo ou d'une automatisation, je vous aide
                à transformer votre idée en solution concrète.
            </p>
            <a href="contact.php" class="btn btn-primary">Demander un devis</a>
        </div>
    </section>
</main>

<?php include('includes/footer.php'); ?>