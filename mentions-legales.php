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
                Ce site est edite par Vanessa Fedyna.
                Si vous avez une question, vous pouvez m'ecrire a
                <a href="mailto:vanessa@monatech.ca">vanessa@monatech.ca</a>.
            </p>

            <h2>Hebergeur</h2>
            <p>
                Le site est heberge par [Nom de l'hebergeur].
            </p>

            <h2>Propriete intellectuelle</h2>
            <p>
                Les textes, visuels, logos et pages de ce site m'appartiennent ou sont utilises avec autorisation.
                Vous ne pouvez pas les reutiliser sans mon accord ecrit.
            </p>

            <h2>Limitation de responsabilite</h2>
            <p>
                Je fais de mon mieux pour garder les informations de ce site claires et a jour.
                Si une erreur ou une indisponibilite se glisse, je ne peux pas etre tenue responsable des consequences liees a son utilisation.
            </p>

            <h2>Liens externes</h2>
            <p>
                Ce site peut contenir des liens vers d'autres sites.
                Je ne gere pas leur contenu ni leur fonctionnement.
            </p>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
