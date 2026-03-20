<?php
declare(strict_types=1);

if (!headers_sent()) {
    header('Content-Type: text/html; charset=UTF-8');
}

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
$currentPage = basename($requestedPath !== '' ? $requestedPath : ($_SERVER['PHP_SELF'] ?? 'index.php'));
if ($currentPage === '' || $currentPage === '/' || $currentPage === '\\') {
    $currentPage = 'index.php';
}

$site_name = isset($site_name) ? (string) $site_name : 'Freelance Dev Studio';
$asset_base = isset($asset_base) ? rtrim((string) $asset_base, '/') : '';
$brand_mark = isset($brand_mark) ? strtoupper(trim((string) $brand_mark)) : 'FDS';

$page_title = isset($page_title)
    ? (string) $page_title
    : 'Création de sites web pour petites entreprises | ' . $site_name;
$page_description = isset($page_description)
    ? (string) $page_description
    : 'Création de sites web clairs, identité visuelle simple et automatisations pour les petites entreprises.';
$page_og_type = isset($page_og_type) ? (string) $page_og_type : 'website';

// À remplacer par votre vrai domaine de production avant mise en ligne.
$site_base_url = isset($site_base_url) ? (string) $site_base_url : 'https://www.votre-domaine.ca';
$page_path = isset($page_path) ? (string) $page_path : $currentPage;
$canonical_url = rtrim($site_base_url, '/') . '/' . ltrim($page_path, '/');

if (!function_exists('head_escape')) {
    function head_escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('site_url')) {
    function site_url(string $path, string $base = ''): string
    {
        return ($base === '' ? '' : $base) . '/' . ltrim($path, '/');
    }
}

$navItems = [
    ['label' => 'Accueil', 'href' => site_url('/index.php', $asset_base), 'page' => 'index.php'],
    ['label' => 'Services', 'href' => site_url('/services.php', $asset_base), 'page' => 'services.php'],
    ['label' => 'Portfolio', 'href' => site_url('/portfolio.php', $asset_base), 'page' => 'portfolio.php'],
    ['label' => 'À propos', 'href' => site_url('/about.php', $asset_base), 'page' => 'about.php'],
    ['label' => 'Contact', 'href' => site_url('/contact.php', $asset_base), 'page' => 'contact.php'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo head_escape($page_title); ?></title>
    <meta name="description" content="<?php echo head_escape($page_description); ?>">
    <link rel="canonical" href="<?php echo head_escape($canonical_url); ?>">

    <meta property="og:title" content="<?php echo head_escape($page_title); ?>">
    <meta property="og:description" content="<?php echo head_escape($page_description); ?>">
    <meta property="og:type" content="<?php echo head_escape($page_og_type); ?>">
    <meta property="og:url" content="<?php echo head_escape($canonical_url); ?>">
    <meta property="og:site_name" content="<?php echo head_escape($site_name); ?>">

    <!-- Placez vos icônes dans assets/images/ -->
    <link rel="icon" href="<?php echo head_escape(site_url('/assets/images/favicon.ico', $asset_base)); ?>" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo head_escape(site_url('/assets/images/favicon-32x32.png', $asset_base)); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo head_escape(site_url('/assets/images/favicon-16x16.png', $asset_base)); ?>">

    <link rel="stylesheet" href="<?php echo head_escape(site_url('/assets/css/style.css', $asset_base)); ?>">
    <script src="<?php echo head_escape(site_url('/assets/js/script.js', $asset_base)); ?>" defer></script>
</head>
<body>
    <header class="site-header" data-js="premium-nav">
        <div class="container header-inner">
            <a class="brand" href="<?php echo head_escape(site_url('/index.php', $asset_base)); ?>" aria-label="Accueil <?php echo head_escape($site_name); ?>">
                <span class="brand-mark" aria-hidden="true"><?php echo head_escape($brand_mark); ?></span>
                <span class="brand-text"><?php echo head_escape($site_name); ?></span>
            </a>

            <nav id="primary-nav" class="site-nav" aria-label="Navigation principale">
                <ul>
                    <?php foreach ($navItems as $item): ?>
                        <?php $isActive = ($currentPage === $item['page']); ?>
                        <li>
                            <a
                                class="nav-link<?php echo $isActive ? ' is-active' : ''; ?>"
                                href="<?php echo head_escape($item['href']); ?>"
                                <?php echo $isActive ? 'aria-current="page"' : ''; ?>
                            >
                                <?php echo head_escape($item['label']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo head_escape(site_url('/contact.php', $asset_base)); ?>" class="nav-cta-mobile">Discuter de votre projet</a>
            </nav>

            <a href="<?php echo head_escape(site_url('/contact.php', $asset_base)); ?>" class="nav-cta">Discuter de votre projet</a>

            <button
                class="menu-toggle"
                type="button"
                aria-label="Ouvrir ou fermer le menu de navigation"
                aria-expanded="false"
                aria-controls="primary-nav"
            >
                <span class="menu-toggle-line" aria-hidden="true"></span>
                <span class="menu-toggle-line" aria-hidden="true"></span>
                <span class="menu-toggle-line" aria-hidden="true"></span>
            </button>
        </div>
    </header>
