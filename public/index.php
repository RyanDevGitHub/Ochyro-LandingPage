<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/InfogeranceController.php';
require_once __DIR__ . '/../app/controllers/CasUsageController.php';
require_once __DIR__ . '/../app/controllers/ContactController.php';
require_once __DIR__ . '/../app/controllers/BlogController.php';
require_once __DIR__ . '/../app/controllers/LeadMagnetController.php';
require_once __DIR__ . '/../app/controllers/LegalController.php';
require_once __DIR__ . '/../app/controllers/CybersecuriteController.php';
require_once __DIR__ . '/../app/controllers/CloudMobiliteController.php';

$router = new Router();

$homeController       = new HomeController();
$infogeranceController = new InfogeranceController();
$casUsageController   = new CasUsageController();
$contactController    = new ContactController();
$blogController       = new BlogController();
$leadMagnetController = new LeadMagnetController();
$legalController      = new LegalController();
$cybersecuriteController = new CybersecuriteController();
$cloudMobiliteController = new CloudMobiliteController();

// Lead magnet — POST + OPTIONS (CORS preflight)
$router->add('POST',    '/lead-magnet', [$leadMagnetController, 'subscribe']);
$router->add('OPTIONS', '/lead-magnet', [$leadMagnetController, 'subscribe']);
$router->add('POST',    '/contact', [$contactController, 'submit']);
$router->add('OPTIONS', '/contact', [$contactController, 'submit']);

$router->get('/', [$homeController, 'index']);
$router->get('/rendez-vous-confirme', [$homeController, 'appointmentConfirmed']);
$router->get('/infogerance', [$infogeranceController, 'index']);
$router->get('/cas-usage', [$casUsageController, 'index']);
$router->get('/contact', [$contactController, 'index']);
$router->get('/blog', [$blogController, 'index']);
$router->get('/mentions-legales', [$legalController, 'mentions']);
$router->get('/politique-de-confidentialite', [$legalController, 'privacy']);
$router->get('/cybersecurite', [$cybersecuriteController, 'index']);
$router->get('/cloud-mobilite', [$cloudMobiliteController, 'index']);

foreach (BlogController::slugs() as $blogSlug) {
    $router->get('/blog/' . $blogSlug, static function () use ($blogController, $blogSlug): void {
        $blogController->show($blogSlug);
    });
}

$router->get('/health', static function (): void {
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'ok';
});

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';

if ($router->dispatch($method, $requestUri)) {
    return;
}

http_response_code(404);
header('Content-Type: text/html; charset=UTF-8');
readfile(__DIR__ . '/../app/views/404.html');
