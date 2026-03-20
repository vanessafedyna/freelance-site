<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name('freelance_admin_session');
}

const ADMIN_USERNAME = 'admin';
const ADMIN_PASSWORD_HASH = '$2y$10$w4klBvhAT3v6ELgRN0pbyei0jFCk27RT/g.oo8ofI/PB3gW0I182S';
const ADMIN_SESSION_KEY = 'admin_logged_in';
const ADMIN_SESSION_USERNAME_KEY = 'admin_username';
