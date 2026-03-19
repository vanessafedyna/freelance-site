<?php
if (!headers_sent()) {
    header('Content-Type: text/html; charset=UTF-8');
}

$currentPage = basename($_SERVER['PHP_SELF'] ?? '');
$site_name = isset($site_name) ? (string)$site_name : 'Freelance Dev Studio';

$page_title = isset($page_title) ? (string)$page_title : 'Développeur freelance | Sites web, logos et chatbots | ' . $site_name;
$page_description = isset($page_description) ? (string)$page_description : 'Développeur freelance proposant la création de site web, de logo et de chatbots pour les petites entreprises au Canada.';
$page_keywords = isset($page_keywords) ? (string)$page_keywords : '';
$page_og_type = isset($page_og_type) ? (string)$page_og_type : 'website';

// TODO: Remplacer par votre vrai domaine de production.
$site_base_url = isset($site_base_url) ? (string)$site_base_url : 'https://www.votre-domaine.ca';
$page_path = isset($page_path) ? (string)$page_path : ($currentPage !== '' ? $currentPage : 'index.php');
$canonical_url = rtrim($site_base_url, '/') . '/' . ltrim($page_path, '/');

function head_escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo head_escape($page_title); ?></title>
    <meta name="description" content="<?php echo head_escape($page_description); ?>">
<?php if ($page_keywords !== ''): ?>
    <meta name="keywords" content="<?php echo head_escape($page_keywords); ?>">
<?php endif; ?>
    <link rel="canonical" href="<?php echo head_escape($canonical_url); ?>">

    <meta property="og:title" content="<?php echo head_escape($page_title); ?>">
    <meta property="og:description" content="<?php echo head_escape($page_description); ?>">
    <meta property="og:type" content="<?php echo head_escape($page_og_type); ?>">
    <meta property="og:url" content="<?php echo head_escape($canonical_url); ?>">

    <!-- Placez vos icones dans assets/images/ -->
    <link rel="icon" href="/assets/images/favicon.ico" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16x16.png">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="index.php#home" aria-label="Accueil <?php echo head_escape($site_name); ?>"><?php echo head_escape($site_name); ?></a>

            <button class="menu-toggle" type="button" aria-label="Ouvrir ou fermer le menu de navigation" aria-expanded="false" aria-controls="primary-nav">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </button>

            <nav id="primary-nav" class="site-nav" aria-label="Navigation principale">
                <ul>
                    <li><a href="index.php#home"<?php echo $currentPage === 'index.php' ? ' aria-current="page"' : ''; ?>>Accueil</a></li>
                    <li><a href="services.php"<?php echo $currentPage === 'services.php' ? ' aria-current="page"' : ''; ?>>Services</a></li>
                    <li><a href="portfolio.php"<?php echo $currentPage === 'portfolio.php' ? ' aria-current="page"' : ''; ?>>Portfolio</a></li>
                    <li><a href="about.php"<?php echo $currentPage === 'about.php' ? ' aria-current="page"' : ''; ?>>À propos</a></li>
                    <li><a href="contact.php"<?php echo $currentPage === 'contact.php' ? ' aria-current="page"' : ''; ?>>Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
