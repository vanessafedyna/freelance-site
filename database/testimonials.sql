CREATE TABLE IF NOT EXISTS testimonials (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100)  NOT NULL,
    job_title   VARCHAR(150)  DEFAULT NULL,
    message     TEXT          NOT NULL,
    is_approved TINYINT(1)    NOT NULL DEFAULT 0,
    created_at  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
