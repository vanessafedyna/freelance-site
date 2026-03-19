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
            <div class="portfolio-hero-layout">
                <div class="portfolio-hero-copy" data-reveal>
                    <p class="hero-badge">Réalisations freelance</p>
                    <h1>Mon portfolio</h1>
                    <p class="portfolio-intro">
                        Ces projets illustrent ma manière de construire des expériences web claires,
                        des identités visuelles crédibles et des automatisations utiles pour les petites entreprises.
                    </p>
                    <a href="contact.php" class="btn btn-primary">
                        <span class="button-outer"><span class="button-inner"><span class="button-text">Demander un devis</span></span></span>
                    </a>
                </div>

                <aside class="portfolio-hero-aside" data-reveal aria-label="Valeur apportée">
                    <h2>Ce que ces projets démontrent</h2>
                    <ul class="portfolio-highlight-list">
                        <li>Une approche orientée résultats et conversion.</li>
                        <li>Un design cohérent avec l’image de l’entreprise.</li>
                        <li>Des solutions simples à utiliser et à maintenir.</li>
                    </ul>
                </aside>
            </div>
        </div>
    </section>

    <section class="section portfolio-filter-section">
        <div class="container">
            <div class="portfolio-filters" aria-label="Filtrer les projets" data-reveal>
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
                <article class="project-card" data-reveal>
                    <div class="project-thumb">Mockup</div>
                    <div class="project-head">
                        <p class="project-category">Site web</p>
                        <span class="project-year">2026</span>
                    </div>
                    <h2>Site vitrine pour restaurant</h2>
                    <p>Conception d'un site clair avec menu, horaires, réservations et mise en avant des avis clients.</p>
                    <p class="project-result">Résultat : plus de demandes de réservation en ligne.</p>
                    <div class="project-footer">
                        <a href="contact.php" class="project-link">Voir le projet</a>
                    </div>
                </article>

                <article class="project-card" data-reveal>
                    <div class="project-thumb">Mockup</div>
                    <div class="project-head">
                        <p class="project-category">Site web</p>
                        <span class="project-year">2026</span>
                    </div>
                    <h2>Site web pour coach sportif</h2>
                    <p>Site professionnel responsive avec présentation des offres, témoignages et formulaire d'inscription.</p>
                    <p class="project-result">Résultat : meilleure conversion des visites en prises de rendez-vous.</p>
                    <div class="project-footer">
                        <a href="contact.php" class="project-link">Voir le projet</a>
                    </div>
                </article>

                <article class="project-card" data-reveal>
                    <div class="project-thumb">Logo</div>
                    <div class="project-head">
                        <p class="project-category">Logo</p>
                        <span class="project-year">2026</span>
                    </div>
                    <h2>Logo pour boutique locale</h2>
                    <p>Création d'un logo professionnel et d'une direction visuelle simple pour les supports print et web.</p>
                    <p class="project-result">Résultat : image de marque plus reconnaissable en magasin et en ligne.</p>
                    <div class="project-footer">
                        <a href="contact.php" class="project-link">Voir le projet</a>
                    </div>
                </article>

                <article class="project-card" data-reveal>
                    <div class="project-thumb">Landing</div>
                    <div class="project-head">
                        <p class="project-category">Site web</p>
                        <span class="project-year">2025</span>
                    </div>
                    <h2>Landing page pour salon de beauté</h2>
                    <p>Page de conversion axée sur les prestations, les promotions saisonnières et la prise de contact rapide.</p>
                    <p class="project-result">Résultat : hausse des demandes sur mobile et des appels entrants.</p>
                    <div class="project-footer">
                        <a href="contact.php" class="project-link">Voir le projet</a>
                    </div>
                </article>

                <article class="project-card" data-reveal>
                    <div class="project-thumb">Chatbot</div>
                    <div class="project-head">
                        <p class="project-category">Chatbot</p>
                        <span class="project-year">2025</span>
                    </div>
                    <h2>Chatbot FAQ pour commerce</h2>
                    <p>Assistant conversationnel pour répondre aux questions fréquentes sur les produits et la livraison.</p>
                    <p class="project-result">Résultat : moins de demandes répétitives et service client plus fluide.</p>
                    <div class="project-footer">
                        <a href="contact.php" class="project-link">Voir le projet</a>
                    </div>
                </article>

                <article class="project-card" data-reveal>
                    <div class="project-thumb">Branding</div>
                    <div class="project-head">
                        <p class="project-category">Branding</p>
                        <span class="project-year">2025</span>
                    </div>
                    <h2>Identité visuelle pour petite entreprise</h2>
                    <p>Mise en place d'une identité cohérente : logo, palette, typographies et règles d'usage principales.</p>
                    <p class="project-result">Résultat : communication plus uniforme sur le web et les réseaux sociaux.</p>
                    <div class="project-footer">
                        <a href="contact.php" class="project-link">Voir le projet</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section portfolio-values">
        <div class="container">
            <h2 class="section-title" data-reveal">Une approche orientée résultats</h2>
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
            <h2>Discutons de votre prochain projet</h2>
            <p>
                Que vous ayez besoin d'un site web, d'un logo ou d'une automatisation, je vous aide
                à transformer votre idée en solution concrète.
            </p>
            <a href="contact.php" class="btn btn-primary">
                <span class="button-outer"><span class="button-inner"><span class="button-text">Demander un devis</span></span></span>
            </a>
        </div>
    </section>
</main>

<?php include('includes/footer.php'); ?>
