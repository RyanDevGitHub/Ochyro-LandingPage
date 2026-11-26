<?php

declare(strict_types=1);

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/BrevoService.php';

final class ContactController extends Controller
{
    private BrevoService $brevo;

    public function __construct()
    {
        $this->brevo = new BrevoService();
    }

    public function index(): void
    {
        $this->render('contact.php');
    }

    public function submit(): void
    {
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(204);
            return;
        }

        $body = (string) file_get_contents('php://input');
        $data = json_decode($body, true);

        if (!is_array($data)) {
            $data = $_POST;
        }

        $name = trim((string) ($data['name'] ?? ''));
        $email = trim((string) ($data['email'] ?? ''));
        $phone = trim((string) ($data['phone'] ?? ''));
        $message = trim((string) ($data['message'] ?? ''));

        // Champ piège invisible : seuls les robots le remplissent. On répond « succès » sans rien envoyer.
        if (trim((string) ($data['website'] ?? '')) !== '') {
            http_response_code(200);
            echo json_encode(['success' => true]);
            return;
        }

        if ($name === '' || $email === '' || $message === '') {
            http_response_code(422);
            echo json_encode(['success' => false, 'error' => 'Merci de renseigner votre nom, votre email et votre message.']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(422);
            echo json_encode(['success' => false, 'error' => 'Adresse email invalide.']);
            return;
        }

        $sent = $this->brevo->sendContactRequest($name, $email, $phone, $message);

        if (!$sent) {
            error_log('[Ochyro Contact] Echec envoi Brevo pour : ' . $email);
            http_response_code(502);
            echo json_encode(['success' => false, 'error' => 'Envoi impossible pour le moment. Réessayez dans quelques minutes.']);
            return;
        }

        http_response_code(200);
        echo json_encode(['success' => true]);
    }
}
