<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (($_SESSION[ADMIN_SESSION_KEY] ?? false) === true) {
    header('Location: projects.php');
    exit;
}

$errorMessage = '';
$usernameValue = '';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $usernameValue = trim((string) ($_POST['username'] ?? ''));
    $passwordValue = (string) ($_POST['password'] ?? '');

    $isValidUser = hash_equals(ADMIN_USERNAME, $usernameValue);
    $isValidPassword = password_verify($passwordValue, ADMIN_PASSWORD_HASH);

    if ($isValidUser && $isValidPassword) {
        session_regenerate_id(true);
        $_SESSION[ADMIN_SESSION_KEY] = true;
        $_SESSION[ADMIN_SESSION_USERNAME_KEY] = $usernameValue;

        header('Location: projects.php');
        exit;
    }

    $errorMessage = 'Identifiants invalides.';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion admin</title>
    <style>
        :root {
            color-scheme: light;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: #f5f1e8;
            color: #111318;
        }

        .login-card {
            width: min(92vw, 420px);
            background: #ffffff;
            border: 1px solid #d8d0c2;
            border-radius: 12px;
            padding: 1.4rem;
            box-shadow: 0 8px 22px rgba(17, 19, 24, 0.08);
        }

        h1 {
            margin: 0 0 1rem;
            font-size: 1.4rem;
        }

        .field {
            display: grid;
            gap: 0.4rem;
            margin-bottom: 0.9rem;
        }

        label {
            font-size: 0.95rem;
            font-weight: 600;
        }

        input {
            border: 1px solid #d8d0c2;
            border-radius: 8px;
            padding: 0.65rem 0.75rem;
            font: inherit;
        }

        input:focus {
            outline: 2px solid #2f6b66;
            outline-offset: 1px;
            border-color: #2f6b66;
        }

        button {
            border: 1px solid #111318;
            border-radius: 10px;
            background: #111318;
            color: #f5f1e8;
            padding: 0.65rem 0.95rem;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background: #2f6b66;
            border-color: #2f6b66;
        }

        .error {
            margin: 0 0 0.9rem;
            padding: 0.65rem 0.75rem;
            border: 1px solid #e2aaaa;
            border-radius: 8px;
            background: #fdeeee;
            color: #932727;
            font-size: 0.92rem;
        }
    </style>
</head>
<body>
    <main class="login-card">
        <h1>Connexion admin</h1>

        <?php if ($errorMessage !== ''): ?>
            <p class="error"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>

        <form method="post" action="login.php" novalidate>
            <div class="field">
                <label for="username">Identifiant</label>
                <input
                    id="username"
                    name="username"
                    type="text"
                    value="<?php echo htmlspecialchars($usernameValue, ENT_QUOTES, 'UTF-8'); ?>"
                    autocomplete="username"
                    required
                >
            </div>

            <div class="field">
                <label for="password">Mot de passe</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit">Se connecter</button>
        </form>
    </main>
</body>
</html>
