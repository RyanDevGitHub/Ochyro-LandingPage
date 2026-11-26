<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../app/controllers/PageController.php';
require_once __DIR__ . '/../app/controllers/ContactController.php';

$router = new Router();

$pages   = new PageController();
$contact = new ContactController();

// Formulaire de contact — POST + OPTIONS (préflight CORS)
$router->add('POST',    '/contact', [$contact, 'submit']);
$router->add('OPTIONS', '/contact', [$contact, 'submit']);

// Pages
$router->get('/',                             [$pages, 'home']);
$router->get('/services',                     [$pages, 'services']);
$router->get('/cas-usage',                    [$pages, 'useCases']);
$router->get('/contact',                      [$contact, 'index']);
$router->get('/rendez-vous-confirme',         [$pages, 'appointmentConfirmed']);
$router->get('/mentions-legales',             [$pages, 'legalNotice']);
$router->get('/politique-de-confidentialite', [$pages, 'privacy']);

$router->get('/health', static function (): void {
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'ok';
});

$method     = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';

if ($router->dispatch($method, $requestUri)) {
    return;
}

// Anciennes pages (infogérance IT pour cabinets comptables) : redirection permanente
// vers les pages équivalentes pour conserver le référencement et éviter les 404.
$path = rtrim((string) parse_url($requestUri, PHP_URL_PATH), '/');
$legacyRedirects = [
    '/infogerance'   => '/services',
    '/cybersecurite' => '/services',
    '/cloud-mobilite' => '/services',
    '/lead-magnet'   => '/contact',
];

if (in_array($method, ['GET', 'HEAD'], true)) {
    $target = $legacyRedirects[$path] ?? (($path === '/blog' || str_starts_with($path, '/blog/')) ? '/' : null);

    if ($target !== null) {
        header('Location: ' . $target, true, 301);
        return;
    }
}

http_response_code(404);
header('Content-Type: text/html; charset=UTF-8');
require __DIR__ . '/../app/views/404.php';
