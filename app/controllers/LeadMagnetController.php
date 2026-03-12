<?php

declare(strict_types=1);

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/BrevoService.php';

/**
 * LeadMagnetController — Gère la capture email + envoi de la checklist PDF.
 *
 * Route : POST /lead-magnet
 *
 * Payload JSON : { "email": "..." }
 * Réponse JSON : { "success": true } ou { "success": false, "error": "..." }
 */
final class LeadMagnetController extends Controller
{
    private BrevoService $brevo;

    public function __construct()
    {
        $this->brevo = new BrevoService();
    }

    public function subscribe(): void
    {
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');

        // Preflight CORS
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(204);
            return;
        }

        // Lecture du corps JSON
        $body  = (string) file_get_contents('php://input');
        $data  = json_decode($body, true) ?? [];
        $email = trim($data['email'] ?? '');

        // Validation basique
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(422);
            echo json_encode(['success' => false, 'error' => 'Adresse email invalide.']);
            return;
        }

        // Détermine l'URL de base (http(s)://host)
        $scheme      = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host        = $_SERVER['HTTP_HOST'] ?? 'ochyro.net';
        $downloadUrl = "{$scheme}://{$host}/assets/checklist-it-securite.pdf";

        // 1. Ajoute le contact à la liste Brevo (liste 2 par défaut — à ajuster)
        $this->brevo->addContact($email, [2]);

        // 2. Envoie l'email avec le lien de téléchargement
        $sent = $this->brevo->sendLeadMagnet($email, $downloadUrl);

        if (!$sent) {
            // On renvoie quand même succès pour ne pas bloquer l'UX
            // mais on log l'erreur côté serveur
            error_log("[Ochyro LeadMagnet] Échec envoi email pour : {$email}");
        }

        http_response_code(200);
        echo json_encode(['success' => true]);
    }
}
