<?php
declare(strict_types=1);

if (!function_exists('testimonial_default_values')) {
    function testimonial_default_values(): array
    {
        return [
            't_name' => '',
            't_title' => '',
            't_message' => '',
            'consent' => '',
        ];
    }
}

if (!function_exists('handle_testimonial_form')) {
    function handle_testimonial_form(string $method, array $payload): array
    {
        $state = [
            'success' => false,
            'error' => '',
            'values' => testimonial_default_values(),
        ];

        if (strtoupper($method) !== 'POST' || !isset($payload['testimonial_submit'])) {
            return $state;
        }

        if (!validate_csrf_token((string) ($payload['csrf_token'] ?? ''))) {
            http_response_code(403);
            echo 'Requête invalide (CSRF)';
            exit;
        }

        $state['values'] = [
            't_name' => trim((string) ($payload['t_name'] ?? '')),
            't_title' => trim((string) ($payload['t_title'] ?? '')),
            't_message' => trim((string) ($payload['t_message'] ?? '')),
            'consent' => (string) ($payload['consent'] ?? ''),
        ];

        $name = $state['values']['t_name'];
        $title = $state['values']['t_title'];
        $message = $state['values']['t_message'];

        if ($name === '' || mb_strlen($name) > 100) {
            $state['error'] = 'Veuillez entrer votre nom (max 100 caractères).';
            return $state;
        }

        if ($state['values']['consent'] !== '1') {
            $state['error'] = 'Vous devez accepter la politique de confidentialité.';
            return $state;
        }

        if ($message === '' || mb_strlen($message) < 20) {
            $state['error'] = 'Votre avis doit contenir au moins 20 caractères.';
            return $state;
        }

        if (mb_strlen($message) > 1000) {
            $state['error'] = 'Votre avis ne doit pas dépasser 1000 caractères.';
            return $state;
        }

        try {
            $pdo = get_db_connection();
            $insert = $pdo->prepare('INSERT INTO testimonials (name, job_title, message) VALUES (:name, :job_title, :message)');
            $insert->execute([
                'name' => $name,
                'job_title' => $title !== '' ? $title : null,
                'message' => $message,
            ]);
            $state['success'] = true;
            $state['values'] = testimonial_default_values();
        } catch (Throwable $exception) {
            $state['error'] = 'Une erreur est survenue. Veuillez réessayer.';
        }

        return $state;
    }
}
