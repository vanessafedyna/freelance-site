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

$site_name = isset($site_name) ? (string) $site_name : 'MONATECH STUDIO';
$asset_base = isset($asset_base) ? rtrim((string) $asset_base, '/') : '';
$brand_mark = isset($brand_mark) ? strtoupper(trim((string) $brand_mark)) : 'MT';

$page_title = isset($page_title)
    ? (string) $page_title
    : 'Création de sites web pour petites entreprises | ' . $site_name;
$page_description = isset($page_description)
    ? (string) $page_description
    : 'Création de sites web clairs, identité visuelle simple et automatisations pour les petites entreprises.';
$page_og_type = isset($page_og_type) ? (string) $page_og_type : 'website';

// À remplacer par votre vrai domaine de production avant mise en ligne.
$site_base_url = isset($site_base_url) ? (string) $site_base_url : 'https://www.monatech.ca';
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

$brand_logo = isset($brand_logo) ? (string) $brand_logo : site_url('/assets/images/logo-transparent.png', $asset_base);
$style_asset_path = __DIR__ . '/../assets/css/style.css';
$script_asset_path = __DIR__ . '/../assets/js/script.js';
$style_asset_url = site_url('/assets/css/style.css', $asset_base);
$script_asset_url = site_url('/assets/js/script.js', $asset_base);
$style_asset_version = is_file($style_asset_path) ? (string) filemtime($style_asset_path) : '1';
$script_asset_version = is_file($script_asset_path) ? (string) filemtime($script_asset_path) : '1';

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
    <meta property="og:image" content="https://www.monatech.ca/assets/images/monatech-logo.png">
    <meta property="og:image:alt" content="<?php echo head_escape($site_name); ?> — Création de sites web pour petites entreprises">
    <meta property="og:locale" content="fr_CA">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo head_escape($page_title); ?>">
    <meta name="twitter:description" content="<?php echo head_escape($page_description); ?>">
    <meta name="twitter:image" content="https://www.monatech.ca/assets/images/monatech-logo.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap">

    <link rel="icon" type="image/png" href="<?php echo head_escape($brand_logo); ?>">
    <link rel="apple-touch-icon" href="<?php echo head_escape($brand_logo); ?>">

    <link rel="stylesheet" href="<?php echo head_escape($style_asset_url . '?v=' . rawurlencode($style_asset_version)); ?>">
    <script src="<?php echo head_escape($script_asset_url . '?v=' . rawurlencode($script_asset_version)); ?>" defer></script>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Person",
                "@id": "https://www.monatech.ca/#vanessa",
                "name": "Vanessa Fedyna",
                "jobTitle": "Développeure web freelance",
                "url": "https://www.monatech.ca",
                "image": "https://www.monatech.ca/assets/images/10032.png",
                "email": "vanessa@monatech.ca",
                "knowsAbout": ["PHP", "Laravel", "MySQL", "JavaScript", "HTML", "CSS", "Cybersécurité"],
                "worksFor": {
                    "@id": "https://www.monatech.ca/#organisation"
                }
            },
            {
                "@type": "LocalBusiness",
                "@id": "https://www.monatech.ca/#organisation",
                "name": "MONATECH Studio",
                "url": "https://www.monatech.ca",
                "logo": "https://www.monatech.ca/assets/images/monatech-logo.png",
                "image": "https://www.monatech.ca/assets/images/monatech-logo.png",
                "email": "vanessa@monatech.ca",
                "description": "Création de sites web clairs, identité visuelle simple et automatisations pour les petites entreprises au Canada.",
                "founder": {
                    "@id": "https://www.monatech.ca/#vanessa"
                },
                "areaServed": {
                    "@type": "Country",
                    "name": "Canada"
                },
                "hasOfferCatalog": {
                    "@type": "OfferCatalog",
                    "name": "Services web",
                    "itemListElement": [
                        {
                            "@type": "Offer",
                            "itemOffered": {
                                "@type": "Service",
                                "name": "Création de site web",
                                "description": "Site vitrine clair, rapide et professionnel pour petites entreprises."
                            }
                        },
                        {
                            "@type": "Offer",
                            "itemOffered": {
                                "@type": "Service",
                                "name": "Identité visuelle simple",
                                "description": "Logo, palette de couleurs et repères visuels cohérents."
                            }
                        },
                        {
                            "@type": "Offer",
                            "itemOffered": {
                                "@type": "Service",
                                "name": "Automatisations simples",
                                "description": "Réponses automatiques et préqualification des demandes clients."
                            }
                        }
                    ]
                }
            }
        ]
    }
    </script>
</head>
<body>
    <header class="site-header" data-js="premium-nav">
        <div class="container header-inner">
            <a class="brand" href="<?php echo head_escape(site_url('/index.php', $asset_base)); ?>" aria-label="Accueil <?php echo head_escape($site_name); ?>">
                <span class="brand-mark" aria-hidden="true">
                    <img src="<?php echo head_escape($brand_logo); ?>" alt="Logo <?php echo head_escape($site_name); ?>">
                </span>
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
