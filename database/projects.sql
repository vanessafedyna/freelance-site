CREATE TABLE IF NOT EXISTS projects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    category VARCHAR(100) NOT NULL,
    project_type VARCHAR(50) NOT NULL DEFAULT 'demo',
    project_year INT NOT NULL,
    short_description TEXT NOT NULL,
    result_text TEXT NOT NULL,
    thumbnail VARCHAR(255) DEFAULT NULL,
    link_url VARCHAR(255) DEFAULT NULL,
    link_label VARCHAR(100) DEFAULT NULL,
    is_published TINYINT(1) NOT NULL DEFAULT 1,
    display_order INT NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO projects (
    title,
    slug,
    category,
    project_type,
    project_year,
    short_description,
    result_text,
    thumbnail,
    link_url,
    link_label,
    is_published,
    display_order
) VALUES
(
    'Site vitrine pour cabinet comptable',
    'site-vitrine-cabinet-comptable',
    'site web',
    'client',
    2026,
    'Conception d’un site vitrine clair pour présenter les services, rassurer les prospects et simplifier la prise de contact.',
    'Hausse des demandes qualifiées via le formulaire de contact.',
    NULL,
    NULL,
    'Parler d’un projet similaire',
    1,
    10
),
(
    'Identité visuelle pour studio local',
    'identite-visuelle-studio-local',
    'identité visuelle',
    'concept',
    2026,
    'Création d’une identité visuelle simple avec logo, palette et repères graphiques pour harmoniser la présence en ligne.',
    'Image de marque plus cohérente sur le site et les supports digitaux.',
    NULL,
    NULL,
    'Parler d’un projet similaire',
    1,
    20
),
(
    'Automatisation du tri des demandes',
    'automatisation-tri-demandes',
    'automatisation',
    'demo',
    2026,
    'Mise en place d’un flux d’automatisation pour qualifier les demandes entrantes et orienter rapidement vers le bon canal.',
    'Réduction du temps passé sur les demandes répétitives et suivi plus fluide.',
    NULL,
    NULL,
    'Parler d’un projet similaire',
    1,
    30
);
