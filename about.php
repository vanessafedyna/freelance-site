<?php
declare(strict_types=1);

$page_title = 'À propos | Création de sites web pour petites entreprises | MONATECH';
$page_description = 'Découvrez l’approche de MONATECH à Montréal : création de sites web clairs, identité visuelle essentielle et solutions web adaptées aux petites entreprises.';
$page_keywords = 'à propos freelance web, création site web, petites entreprises, identité visuelle, PHP Laravel';
$page_path = 'about.php';

include('includes/header.php');
?>

<main class="about-page">
    <section class="section about-hero">
        <div class="container about-hero-inner">
            <p class="hero-badge">À propos de moi</p>
            <h1>Je crée des sites web clairs pour les petites entreprises.</h1>
            <p class="about-intro">Je conçois des sites web clairs, pro et simples à faire évoluer.</p>
            <a href="contact.php" class="btn btn-primary">
                <span class="button-outer"><span class="button-inner"><span class="button-text">Demander un devis gratuit</span></span></span>
            </a>
        </div>
    </section>

    <section class="section about-profile">
        <div class="container about-profile-grid">
            <div class="about-photo-wrap" data-reveal>
                <img
                    src="/assets/images/10032.png"
                    alt="Vanessa Fedyna — Fondatrice de MONATECH Studio"
                    class="about-photo"
                    width="480"
                    height="580"
                    loading="lazy"
                >
                <div class="about-photo-caption">
                    <p class="about-name">Vanessa Fedyna</p>
                    <p class="about-title-tag">Développeuse web freelance</p>
                </div>
            </div>

            <div class="about-profile-content" data-reveal>
                <h2>Ce que j'apporte</h2>
                <p>Je crée des sites web clairs pour les petites entreprises, avec un vrai souci de lisibilité et de structure.</p>
                <p>Je travaille avec PHP, Laravel, HTML, CSS, JavaScript et MySQL pour construire des bases propres et fiables.</p>
                <p>Ma formation en cybersécurité m'aide aussi à penser des sites plus solides dès le départ.</p>
                <a href="https://www.linkedin.com/in/vanessafedyna/" target="_blank" rel="noopener noreferrer" class="linkedin-link">Voir mon profil LinkedIn</a>

                <h3>Ce que ça signifie pour vous</h3>
                <ul class="tech-stack">
                    <li>Sites évolutifs — Une base propre qui peut grandir avec votre activité.</li>
                    <li>Sécurité intégrée — Je pense aussi la solidité du site dès le départ.</li>
                    <li>Code propre et maintenable — Votre site reste simple à reprendre et à faire évoluer.</li>
                </ul>

                <div class="about-profile-side" aria-label="Positionnement professionnel">
                    <h3>Ce que j’apporte dans un projet</h3>
                    <ul class="about-side-list">
                        <li>Un site web structuré pour mieux présenter votre activité</li>
                        <li>Une identité visuelle essentielle et cohérente</li>
                        <li>Une base technique propre et évolutive</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section about-mission">
        <div class="container">
            <h2 class="section-title">Comment je travaille</h2>
            <p class="section-intro">
                Une manière de travailler claire, directe et adaptée aux besoins réels d’une petite entreprise.
            </p>
            <div class="mission-list">
                <article class="mission-item">
                    <h3>Comprendre le besoin</h3>
                    <p>Je commence par comprendre ce que votre site doit vraiment apporter.</p>
                </article>
                <article class="mission-item">
                    <h3>Proposer une solution claire</h3>
                    <p>Je propose une solution simple, adaptée à votre contexte et à votre budget.</p>
                </article>
                <article class="mission-item">
                    <h3>Concevoir avec clarté</h3>
                    <p>Je construis des pages claires, pensées pour être utiles.</p>
                </article>
                <article class="mission-item">
                    <h3>Avancer avec méthode</h3>
                    <p>J'avance avec des étapes nettes et des échanges directs.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section about-strengths">
        <div class="container">
            <h2 class="section-title">Pourquoi travailler avec moi</h2>
            <div class="about-strength-grid">
                <article class="strength-card">
                    <h3>Site adapté à votre entreprise</h3>
                    <p>Une structure pensée pour votre activité, votre cible et votre marché local.</p>
                </article>
                <article class="strength-card">
                    <h3>Image professionnelle</h3>
                    <p>Un rendu cohérent qui renforce votre crédibilité.</p>
                </article>
                <article class="strength-card">
                    <h3>Communication directe</h3>
                    <p>Des échanges directs, sans intermédiaire ni flou.</p>
                </article>
                <article class="strength-card">
                    <h3>Approche orientée résultats</h3>
                    <p>Je gère votre projet du début à la mise en ligne.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section about-final-cta">
        <div class="container cta-box about-cta-box">
            <h2>Parlons de votre projet.</h2>
            <p>Si vous avez besoin d'un site clair et utile, je peux vous aider à le construire.</p>
            <a href="contact.php" class="btn btn-primary">
                <span class="button-outer"><span class="button-inner"><span class="button-text">Demander un devis gratuit</span></span></span>
            </a>
        </div>
    </section>
</main>

<?php include('includes/footer.php'); ?>
