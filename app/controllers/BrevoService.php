<?php

declare(strict_types=1);

/**
 * BrevoService — Appels directs à l'API REST Brevo v3
 * Utilisé pour envoyer les demandes du formulaire de contact par email.
 *
 * Clé API : BREVO_API_KEY dans le fichier .env à la racine du projet.
 */
final class BrevoService
{
    private string $apiKey;
    private string $senderEmail;
    private string $senderName;

    public function __construct()
    {
        // Charge .env si pas encore chargé
        $envPath = __DIR__ . '/../../.env';
        if (is_file($envPath)) {
            foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) {
                    continue;
                }
                [$key, $value] = explode('=', $line, 2);
                $_ENV[trim($key)] = trim($value, " \t\n\r\0\x0B\"'");
            }
        }

        $this->apiKey      = $_ENV['BREVO_API_KEY'] ?? '';
        $this->senderEmail = $_ENV['BREVO_SENDER_EMAIL'] ?? 'contact@ochyro.net';
        $this->senderName  = $_ENV['BREVO_SENDER_NAME']  ?? 'Ochyro';
    }

    public function sendContactRequest(string $name, string $email, string $phone, string $message): bool
    {
        $recipient = $_ENV['BREVO_CONTACT_RECIPIENT'] ?? $this->senderEmail;
        $subject = 'Nouvelle demande de contact - ' . $name;
        $html = $this->buildContactEmail($name, $email, $phone, $message);

        $payload = [
            'sender' => ['name' => $this->senderName, 'email' => $this->senderEmail],
            'to' => [['email' => $recipient]],
            'replyTo' => ['email' => $email, 'name' => $name],
            'subject' => $subject,
            'htmlContent' => $html,
        ];

        $response = $this->post('https://api.brevo.com/v3/smtp/email', $payload);
        return isset($response['messageId']);
    }

    // ── Privés ────────────────────────────────────────────────────────────────

    private function post(string $url, array $payload): array
    {
        $jsonPayload = json_encode($payload);
        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'api-key: ' . $this->apiKey,
        ];

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $jsonPayload,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_TIMEOUT => 10,
            ]);

            $body = curl_exec($ch);
            $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);

            if (is_string($body) && $body !== '') {
                return json_decode($body, true) ?? [];
            }

            if ($curlError !== '') {
                error_log('[Ochyro Brevo] curl error: ' . $curlError);
            }

            if ($code >= 500) {
                return [];
            }
        }

        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => implode("\r\n", $headers),
                'content' => $jsonPayload,
                'ignore_errors' => true,
                'timeout' => 10,
            ],
        ]);

        $body = @file_get_contents($url, false, $context);
        if (!is_string($body) || $body === '') {
            return [];
        }

        return json_decode($body, true) ?? [];
    }

    private function buildContactEmail(string $name, string $email, string $phone, string $message): string
    {
        $safeName = htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $safeEmail = htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $safePhone = htmlspecialchars($phone !== '' ? $phone : 'Non renseigné', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));

        return <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;padding:24px;background:#f5f7fa;font-family:Arial,sans-serif;color:#22304a;">
  <table width="100%" cellpadding="0" cellspacing="0" style="max-width:680px;margin:0 auto;background:#ffffff;border-radius:10px;overflow:hidden;">
    <tr>
      <td style="background:#22304a;padding:24px 28px;color:#ffffff;">
        <div style="font-size:22px;font-weight:bold;">Nouvelle demande de contact</div>
        <div style="margin-top:6px;font-size:13px;color:#d7e3f4;">Formulaire site Ochyro</div>
      </td>
    </tr>
    <tr>
      <td style="padding:28px;">
        <p style="margin:0 0 16px;font-size:14px;line-height:1.6;">Une nouvelle demande vient d'être envoyée depuis la page contact.</p>
        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
          <tr>
            <td style="padding:10px 0;border-bottom:1px solid #e5e7eb;width:180px;font-weight:bold;">Nom / Cabinet</td>
            <td style="padding:10px 0;border-bottom:1px solid #e5e7eb;">{$safeName}</td>
          </tr>
          <tr>
            <td style="padding:10px 0;border-bottom:1px solid #e5e7eb;font-weight:bold;">Email</td>
            <td style="padding:10px 0;border-bottom:1px solid #e5e7eb;">{$safeEmail}</td>
          </tr>
          <tr>
            <td style="padding:10px 0;border-bottom:1px solid #e5e7eb;font-weight:bold;">Téléphone</td>
            <td style="padding:10px 0;border-bottom:1px solid #e5e7eb;">{$safePhone}</td>
          </tr>
          <tr>
            <td style="padding:14px 0 8px;font-weight:bold;vertical-align:top;">Message</td>
            <td style="padding:14px 0 8px;line-height:1.7;">{$safeMessage}</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
HTML;
    }
}
