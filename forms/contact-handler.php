<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/db.php';

function contact_project_options(): array
{
    return [
        'Site web',
        'Logo',
        'Chatbot / automatisation',
        'Autre',
    ];
}

function contact_budget_options(): array
{
    return [
        'Moins de 500 $ CA',
        '500 $ CA à 1 000 $ CA',
        '1 000 $ CA à 3 000 $ CA',
        'Plus de 3 000 $ CA',
    ];
}

function contact_default_values(): array
{
    return [
        'nom' => '',
        'email' => '',
        'type_projet' => '',
        'budget_estime' => '',
        'message' => '',
    ];
}

function contact_sanitize_line(string $value): string
{
    $clean = trim(strip_tags($value));
    return preg_replace('/\s+/', ' ', $clean) ?? '';
}

function contact_sanitize_message(string $value): string
{
    $clean = trim(strip_tags($value));
    $clean = preg_replace("/\r\n?/", "\n", $clean) ?? '';
    return preg_replace('/[ \t]+/', ' ', $clean) ?? '';
}

function contact_text_length(string $value): int
{
    if (function_exists('mb_strlen')) {
        return mb_strlen($value);
    }

    return strlen($value);
}

function contact_insert_request(array $values): bool
{
    $pdo = get_db_connection();

    $sql = 'INSERT INTO contact_requests (nom, email, type_projet, budget_estime, message, created_at)
            VALUES (:nom, :email, :type_projet, :budget_estime, :message, NOW())';

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        ':nom' => $values['nom'],
        ':email' => $values['email'],
        ':type_projet' => $values['type_projet'],
        ':budget_estime' => $values['budget_estime'],
        ':message' => $values['message'],
    ]);
}

function handle_contact_form(string $method, array $payload): array
{
    $state = [
        'submitted' => false,
        'success' => '',
        'errors' => [],
        'values' => contact_default_values(),
    ];

    if (strtoupper($method) !== 'POST') {
        return $state;
    }

    $state['submitted'] = true;

    $values = [
        'nom' => contact_sanitize_line((string)($payload['nom'] ?? '')),
        'email' => filter_var(trim((string)($payload['email'] ?? '')), FILTER_SANITIZE_EMAIL) ?: '',
        'type_projet' => contact_sanitize_line((string)($payload['type_projet'] ?? '')),
        'budget_estime' => contact_sanitize_line((string)($payload['budget_estime'] ?? '')),
        'message' => contact_sanitize_message((string)($payload['message'] ?? '')),
    ];

    $errors = [];

    if ($values['nom'] === '') {
        $errors['nom'] = 'Le nom est obligatoire.';
    } elseif (contact_text_length($values['nom']) > 120) {
        $errors['nom'] = 'Le nom est trop long.';
    }

    if ($values['email'] === '') {
        $errors['email'] = 'L\'email est obligatoire.';
    } elseif (filter_var($values['email'], FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Veuillez entrer une adresse email valide.';
    } elseif (contact_text_length($values['email']) > 190) {
        $errors['email'] = 'L\'adresse email est trop longue.';
    }

    if ($values['type_projet'] === '') {
        $errors['type_projet'] = 'Veuillez sélectionner un type de projet.';
    } elseif (!in_array($values['type_projet'], contact_project_options(), true)) {
        $errors['type_projet'] = 'Le type de projet sélectionné est invalide.';
    }

    if ($values['budget_estime'] === '') {
        $errors['budget_estime'] = 'Veuillez sélectionner un budget estimé.';
    } elseif (!in_array($values['budget_estime'], contact_budget_options(), true)) {
        $errors['budget_estime'] = 'Le budget sélectionné est invalide.';
    }

    if ($values['message'] === '') {
        $errors['message'] = 'Le message est obligatoire.';
    } elseif (contact_text_length($values['message']) < 20) {
        $errors['message'] = 'Le message doit contenir au moins 20 caractères.';
    } elseif (contact_text_length($values['message']) > 3000) {
        $errors['message'] = 'Le message est trop long (3000 caractères max).';
    }

    $state['values'] = $values;
    $state['errors'] = $errors;

    if (!empty($errors)) {
        return $state;
    }

    try {
        $inserted = contact_insert_request($values);
    } catch (Throwable $exception) {
        error_log('Erreur insertion contact_requests: ' . $exception->getMessage());
        $state['errors']['database'] = 'Une erreur technique est survenue. Merci de réessayer dans quelques minutes.';
        return $state;
    }

    if (!$inserted) {
        $state['errors']['database'] = 'Impossible d\'enregistrer votre demande pour le moment. Merci de réessayer.';
        return $state;
    }

    $state['success'] = 'Merci, votre demande a bien été envoyée. Je vous réponds sous 24 à 48 heures.';
    $state['values'] = contact_default_values();

    return $state;
}