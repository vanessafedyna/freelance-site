<?php
declare(strict_types=1);

$page_title = 'À propos | Création de sites web pour petites entreprises | MONATECH';
$page_description = 'Découvrez l’approche de MONATECH : création de sites web clairs, identité visuelle simple et solutions web adaptées aux petites entreprises.';
$page_keywords = 'à propos freelance web, création site web, petites entreprises, identité visuelle, PHP Laravel';
$page_path = 'about.php';

include('includes/header.php');
?>

<main class="about-page">
    <section class="section about-hero">
        <div class="container about-hero-inner">
            <p class="hero-badge">À propos de MONATECH</p>
            <h1>Je conçois des sites web clairs, utiles et adaptés aux petites entreprises.</h1>
            <p class="about-intro">
                Mon objectif est de créer des solutions web simples, professionnelles et faciles à faire évoluer, avec une approche claire du besoin jusqu’à la mise en ligne.
            </p>
            <a href="contact.php" class="btn btn-primary">
                <span class="button-outer"><span class="button-inner"><span class="button-text">Me contacter</span></span></span>
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
                    <p class="about-title-tag">Fondatrice · MONATECH Studio</p>
                </div>
            </div>

            <div class="about-profile-content" data-reveal>
                <h2>Un profil orienté web, clarté et solutions concrètes</h2>
                <p>
                    Je travaille principalement sur des projets de création de site web pour petites entreprises, avec une attention particulière à la lisibilité, à la structure du contenu et à la facilité d’utilisation.
                </p>
                <p>
                    J’utilise des technologies comme PHP, Laravel, HTML, CSS, JavaScript et MySQL pour construire des sites fiables, clairs et évolutifs. Ma formation en cybersécurité me permet aussi d’aborder les projets avec une attention particulière à la sécurité et à la solidité de la base.
                </p>

                <h3>Stack technique</h3>
                <ul class="tech-stack">
                    <li>PHP</li>
                    <li>Laravel</li>
                    <li>MySQL</li>
                    <li>JavaScript</li>
                    <li>HTML</li>
                    <li>CSS</li>
                </ul>

                <div class="about-profile-side" aria-label="Positionnement professionnel">
                    <h3>Ce que j’apporte dans un projet</h3>
                    <ul class="about-side-list">
                        <li>Un site web structuré pour mieux présenter votre activité</li>
                        <li>Une identité visuelle simple et cohérente</li>
                        <li>Une base technique propre et évolutive</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section about-mission">
        <div class="container">
            <h2 class="section-title">Mission et approche</h2>
            <p class="section-intro">
                Une manière de travailler simple, claire et adaptée aux besoins réels d’une petite entreprise.
            </p>
            <div class="mission-list">
                <article class="mission-item">
                    <h3>Comprendre le besoin</h3>
                    <p>Je prends le temps de comprendre votre activité, vos priorités et ce que votre site doit réellement apporter.</p>
                </article>
                <article class="mission-item">
                    <h3>Proposer une solution claire</h3>
                    <p>Je privilégie des choix adaptés à votre contexte, à votre budget et à votre niveau de maturité digitale.</p>
                </article>
                <article class="mission-item">
                    <h3>Concevoir avec clarté</h3>
                    <p>Je construis des pages lisibles, structurées et pensées pour être utiles à vos visiteurs.</p>
                </article>
                <article class="mission-item">
                    <h3>Avancer simplement</h3>
                    <p>Le projet progresse avec des étapes nettes, des échanges directs et des décisions expliquées.</p>
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
                    <p>Une structure pensée pour vos services, votre cible et votre marché local.</p>
                </article>
                <article class="strength-card">
                    <h3>Image professionnelle</h3>
                    <p>Un rendu cohérent qui renforce la crédibilité de votre activité.</p>
                </article>
                <article class="strength-card">
                    <h3>Communication simple</h3>
                    <p>Des échanges directs, des choix argumentés et un cadre clair.</p>
                </article>
                <article class="strength-card">
                    <h3>Approche orientée résultats</h3>
                    <p>Des livrables concrets pour vous aider à obtenir plus de demandes qualifiées.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section about-final-cta">
        <div class="container cta-box about-cta-box">
            <h2>Parlons du site web dont votre entreprise a réellement besoin.</h2>
            <p>
                Que vous partiez de zéro ou que vous souhaitiez clarifier un projet existant,
                je peux vous aider à construire une solution web claire, utile et adaptée à votre activité.
            </p>
            <a href="contact.php" class="btn btn-primary">
                <span class="button-outer"><span class="button-inner"><span class="button-text">Me contacter</span></span></span>
            </a>
        </div>
    </section>
</main>

<?php include('includes/footer.php'); ?>
