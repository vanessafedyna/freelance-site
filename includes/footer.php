<?php
$footer_site_name = isset($site_name) ? (string) $site_name : 'Freelance Dev Studio';
$footer_asset_base = isset($asset_base) ? rtrim((string) $asset_base, '/') : '';
$footer_brand_mark = isset($brand_mark) ? strtoupper(trim((string) $brand_mark)) : 'FDS';

if (!function_exists('footer_escape')) {
    function footer_escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

$footer_url = static function (string $path) use ($footer_asset_base): string {
    if (function_exists('site_url')) {
        return site_url($path, $footer_asset_base);
    }

    return ($footer_asset_base === '' ? '' : $footer_asset_base) . '/' . ltrim($path, '/');
};
?>
    <footer class="site-footer" aria-label="Pied de page">
        <div class="container footer-shell">
            <div class="footer-grid">
                <section class="footer-col footer-branding" aria-label="Présentation">
                    <a class="footer-brand" href="<?php echo footer_escape($footer_url('/index.php')); ?>" aria-label="Accueil <?php echo footer_escape($footer_site_name); ?>">
                        <span class="footer-brand-mark" aria-hidden="true"><?php echo footer_escape($footer_brand_mark); ?></span>
                        <span class="footer-brand-text"><?php echo footer_escape($footer_site_name); ?></span>
                    </a>
                    <p class="footer-tagline">
                        Création de sites web, branding et automatisations pour les petites entreprises.
                    </p>
                </section>

                <nav class="footer-col" aria-label="Navigation du pied de page">
                    <h2 class="footer-title">Navigation</h2>
                    <ul class="footer-links">
                        <li><a href="<?php echo footer_escape($footer_url('/index.php')); ?>">Accueil</a></li>
                        <li><a href="<?php echo footer_escape($footer_url('/services.php')); ?>">Services</a></li>
                        <li><a href="<?php echo footer_escape($footer_url('/portfolio.php')); ?>">Portfolio</a></li>
                        <li><a href="<?php echo footer_escape($footer_url('/about.php')); ?>">À propos</a></li>
                        <li><a href="<?php echo footer_escape($footer_url('/contact.php')); ?>">Contact</a></li>
                    </ul>
                </nav>

                <section class="footer-col" aria-label="Services">
                    <h2 class="footer-title">Services</h2>
                    <ul class="footer-links">
                        <li><a href="<?php echo footer_escape($footer_url('/services.php')); ?>">Création de site web</a></li>
                        <li><a href="<?php echo footer_escape($footer_url('/services.php')); ?>">Logo / identité visuelle</a></li>
                        <li><a href="<?php echo footer_escape($footer_url('/services.php')); ?>">Chatbot / automatisation</a></li>
                    </ul>
                </section>

                <section class="footer-col footer-contact" aria-label="Contact">
                    <h2 class="footer-title">Contact</h2>
                    <p class="footer-contact-line"><a href="mailto:you@example.com">you@example.com</a></p>
                    <a href="<?php echo footer_escape($footer_url('/contact.php')); ?>" class="footer-cta">Discuter de votre projet</a>
                    <p class="footer-response">Réponse sous 24h ouvrées.</p>
                </section>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo footer_escape($footer_site_name); ?>. Tous droits réservés.</p>
                <nav class="footer-legal" aria-label="Informations légales">
                    <a href="<?php echo footer_escape($footer_url('/politique-confidentialite.php')); ?>">Politique de confidentialité</a>
                    <a href="<?php echo footer_escape($footer_url('/mentions-legales.php')); ?>">Mentions légales</a>
                </nav>
            </div>
        </div>
    </footer>
</body>
</html>
