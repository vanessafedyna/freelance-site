<?php
declare(strict_types=1);

$page_title = 'Mentions legales | MONATECH Studio';
$page_description = 'Consultez les mentions legales du site MONATECH Studio : editeur, hebergement, propriete intellectuelle et responsabilite.';
$page_path = 'mentions-legales.php';

include __DIR__ . '/includes/header.php';
?>

<main class="legal-page">
    <section class="section">
        <div class="container">
            <p class="hero-badge">Informations legales</p>
            <h1>Mentions legales</h1>

            <h2>Editeur du site</h2>
            <p>
                Le site est edite par MONATECH Studio.
                Pour toute demande, vous pouvez contacter l\'editeur a l\'adresse
                <a href="mailto:vanessa@monatech.ca">vanessa@monatech.ca</a>.
            </p>

            <h2>Hebergeur</h2>
            <p>
                Le site est heberge par [Nom de l\'hebergeur].
            </p>

            <h2>Propriete intellectuelle</h2>
            <p>
                L\'ensemble des contenus presents sur ce site, incluant notamment les textes, visuels, elements graphiques, logos
                et structures de pages, est protege par les lois applicables en matiere de propriete intellectuelle.
                Sauf autorisation ecrite prealable, toute reproduction, representation, adaptation ou reutilisation, meme partielle,
                est interdite.
            </p>

            <h2>Limitation de responsabilite</h2>
            <p>
                MONATECH Studio s\'efforce de fournir des informations exactes et a jour, mais ne peut garantir l\'absence totale d\'erreurs,
                d\'omissions ou d\'indisponibilites. L\'utilisation du site se fait sous la responsabilite de l\'utilisateur.
                MONATECH Studio ne pourra etre tenu responsable des dommages directs ou indirects lies a l\'utilisation du site.
            </p>

            <h2>Liens externes</h2>
            <p>
                Le site peut contenir des liens vers des sites tiers. MONATECH Studio n\'est pas responsable du contenu
                ou des pratiques de ces sites externes.
            </p>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
