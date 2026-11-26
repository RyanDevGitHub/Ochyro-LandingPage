<?php
$page = [
    'title'       => 'Page introuvable | Ochyro',
    'description' => 'Cette page n’existe pas ou a été déplacée.',
    'path'        => '/404',
    'robots'      => 'noindex, nofollow',
];
require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>

<section class="center-page">
    <div class="container">
        <div class="big-num" aria-hidden="true">404</div>
        <h1>Cette page n’existe pas.</h1>
        <p>Elle a peut-être été déplacée. Voici de quoi retrouver votre chemin.</p>
        <div class="hero-cta">
            <a class="btn btn-primary" href="/">Retour à l’accueil</a>
            <a class="btn btn-ghost" href="/contact#rdv">Réserver un appel gratuit</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
