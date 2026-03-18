<?php
declare(strict_types=1);

$page_title = 'À propos | Développeur freelance PHP, JavaScript, HTML, CSS | Freelance Dev Studio';
$page_description = 'Développeur freelance spécialisé en PHP, JavaScript, HTML et CSS. Solutions web sur mesure pour petites entreprises au Canada.';
$page_keywords = 'développeur freelance, PHP, JavaScript, HTML, CSS, solutions web petites entreprises';
$page_path = 'about.php';

include('includes/header.php');
?>

<main class="about-page">
    <section class="section about-hero">
        <div class="container about-hero-inner">
            <p class="hero-badge">Freelance digital</p>
            <h1>À propos</h1>
            <p class="about-intro">
                Je suis développeur freelance et j'accompagne les petites entreprises à construire
                une présence en ligne solide, professionnelle et utile pour leur croissance.
            </p>
            <a href="contact.php" class="btn btn-primary">Me contacter</a>
        </div>
    </section>

    <section class="section about-profile">
        <div class="container about-profile-grid">
            <article class="about-profile-card">
                <h2>Développeur freelance pour vos projets web et branding</h2>
                <p>
                    J'interviens sur des projets de création de site web, de logo et d'automatisation
                    avec une approche claire : livrer des solutions modernes, responsives et utiles au quotidien.
                </p>
                <h3>Technologies principales</h3>
                <ul class="tech-stack">
                    <li>PHP</li>
                    <li>JavaScript</li>
                    <li>HTML</li>
                    <li>CSS</li>
                </ul>
                <p class="about-profile-note">
                    Mon objectif est de proposer des solutions fiables, simples à utiliser et faciles à faire évoluer.
                </p>
            </article>

            <aside class="about-profile-side" aria-label="Positionnement professionnel">
                <h3>Ce que je construis</h3>
                <ul class="about-side-list">
                    <li>Sites web clairs et adaptés aux petites structures</li>
                    <li>Identités visuelles cohérentes pour renforcer la marque</li>
                    <li>Automatisations pratiques pour gagner du temps</li>
                </ul>
                <p>
                    Chaque projet est pensé pour vous aider à mieux communiquer, inspirer confiance
                    et faciliter la prise de contact de vos clients.
                </p>
            </aside>
        </div>
    </section>

    <section class="section about-mission">
        <div class="container">
            <h2 class="section-title">Mission et approche</h2>
            <p class="section-intro">
                Une méthode de travail structurée pour transformer une idée en résultat concret.
            </p>
            <div class="mission-list">
                <article class="mission-item">
                    <h3>Écoute du besoin</h3>
                    <p>Je prends le temps de comprendre votre activité, vos priorités et vos objectifs.</p>
                </article>
                <article class="mission-item">
                    <h3>Solutions sur mesure</h3>
                    <p>Chaque proposition est adaptée à votre contexte et à vos ressources.</p>
                </article>
                <article class="mission-item">
                    <h3>Design clair et professionnel</h3>
                    <p>Je privilégie des interfaces lisibles, modernes et efficaces pour vos visiteurs.</p>
                </article>
                <article class="mission-item">
                    <h3>Accompagnement de projet</h3>
                    <p>Vous avancez avec un suivi simple, des étapes nettes et des décisions expliquées.</p>
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
            <h2>Parlons de votre projet</h2>
            <p>
                Vous avez une idée de site web, de logo ou d'automatisation ? Je vous aide à la cadrer
                puis à la transformer en solution professionnelle.
            </p>
            <a href="contact.php" class="btn btn-primary">Me contacter</a>
        </div>
    </section>
</main>

<?php include('includes/footer.php'); ?>