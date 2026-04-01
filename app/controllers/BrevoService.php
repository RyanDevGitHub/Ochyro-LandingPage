<?php

declare(strict_types=1);

/**
 * BrevoService — Appels directs à l'API REST Brevo v3
 * Utilisé pour ajouter un contact à une liste et envoyer un email transactionnel.
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

    /**
     * Ajoute un contact à une liste Brevo.
     *
     * @param string   $email    Adresse email du contact
     * @param int[]    $listIds  IDs de listes Brevo (ex : [2])
     * @param string[] $attrs    Attributs supplémentaires (PRENOM, NOM…)
     * @return bool Succès
     */
    public function addContact(string $email, array $listIds = [], array $attrs = []): bool
    {
        $payload = ['email' => $email, 'updateEnabled' => true];
        if (!empty($listIds)) {
            $payload['listIds'] = $listIds;
        }
        if (!empty($attrs)) {
            $payload['attributes'] = $attrs;
        }

        $response = $this->post('https://api.brevo.com/v3/contacts', $payload);
        return isset($response['id']) || isset($response['email']);
    }

    /**
     * Envoie un email transactionnel avec le lien de téléchargement du PDF.
     *
     * @param string $to          Email du destinataire
     * @param string $downloadUrl URL absolue du PDF
     * @return bool Succès
     */
    public function sendLeadMagnet(string $to, string $downloadUrl): bool
    {
        $html = $this->buildLeadMagnetEmail($downloadUrl);

        $payload = [
            'sender'      => ['name' => $this->senderName, 'email' => $this->senderEmail],
            'to'          => [['email' => $to]],
            'subject'     => 'Votre Checklist IT de sécurité — Ochyro',
            'htmlContent' => $html,
        ];

        $response = $this->post('https://api.brevo.com/v3/smtp/email', $payload);
        return isset($response['messageId']);
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

    private function buildLeadMagnetEmail(string $downloadUrl): string
    {
        return <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;padding:0;background:#f5f7fa;font-family:Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f7fa;padding:32px 0;">
    <tr><td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.08);">

        <!-- Header -->
        <tr>
          <td style="background:#22304a;padding:28px 32px;">
            <p style="margin:0;font-size:22px;font-weight:bold;color:#ffffff;">Ochyro</p>
            <p style="margin:4px 0 0;font-size:12px;color:#93c5fd;">Infogérance & cybersécurité pour cabinets comptables</p>
          </td>
        </tr>

        <!-- Body -->
        <tr>
          <td style="padding:32px;">
            <h1 style="margin:0 0 12px;font-size:20px;color:#22304a;">Votre checklist est prête ✅</h1>
            <p style="margin:0 0 20px;color:#4b5563;line-height:1.6;font-size:15px;">
              Merci pour votre intérêt ! Vous trouverez ci-dessous le lien de téléchargement de votre
              <strong>Checklist IT de sécurité pour cabinets d'expertise comptable</strong>
              — 20 points à vérifier avant la prochaine période fiscale.
            </p>

            <!-- CTA Button -->
            <table cellpadding="0" cellspacing="0" style="margin:0 0 28px;">
              <tr>
                <td style="background:#0F52EA;border-radius:6px;padding:14px 28px;">
                  <a href="{$downloadUrl}" style="color:#ffffff;font-size:15px;font-weight:bold;text-decoration:none;">
                    📥 Télécharger ma checklist (PDF)
                  </a>
                </td>
              </tr>
            </table>

            <p style="margin:0 0 12px;color:#4b5563;font-size:14px;line-height:1.6;">
              La checklist couvre les 4 domaines critiques pour votre cabinet :
            </p>
            <ul style="color:#4b5563;font-size:14px;line-height:1.8;padding-left:20px;margin:0 0 24px;">
              <li><strong>Sauvegardes & continuité</strong> — règle 3-2-1, tests de restauration</li>
              <li><strong>Sécurité & accès</strong> — 2FA, gestion des droits, postes à jour</li>
              <li><strong>Conformité RGPD</strong> — registre, DPA sous-traitants, notification incidents</li>
              <li><strong>Logiciels métier</strong> — Cegid / Sage / ACD, SLA, licences</li>
            </ul>

            <p style="margin:0 0 8px;color:#4b5563;font-size:14px;">
              <strong>Votre score est inférieur à 14/20 ?</strong><br>
              Réservez votre audit IT gratuit de 30 minutes avec un expert Ochyro.
            </p>

            <table cellpadding="0" cellspacing="0">
              <tr>
                <td style="border:2px solid #22304a;border-radius:6px;padding:12px 24px;">
                  <a href="https://ochyro.net/#diagnostic" style="color:#22304a;font-size:14px;font-weight:bold;text-decoration:none;">
                    Réserver mon audit gratuit →
                  </a>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <!-- Footer -->
        <tr>
          <td style="background:#f9fafb;padding:20px 32px;border-top:1px solid #e5e7eb;">
            <p style="margin:0;color:#9ca3af;font-size:12px;line-height:1.6;">
              © 2025 Ochyro · <a href="https://ochyro.net" style="color:#0F52EA;">ochyro.net</a><br>
              Vous recevez cet email car vous avez téléchargé un document sur ochyro.net.
            </p>
          </td>
        </tr>

      </table>
    </td></tr>
  </table>
</body>
</html>
HTML;
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
