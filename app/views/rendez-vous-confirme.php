<?php
$page = [
    'title'       => 'Rendez-vous confirmé | Ochyro',
    'description' => 'Votre appel gratuit avec Ochyro est confirmé.',
    'path'        => '/rendez-vous-confirme',
    'robots'      => 'noindex, nofollow',
];
require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>

<section class="center-page">
    <div class="container">
        <span class="eyebrow">Rendez-vous confirmé</span>
        <h1>C’est réservé, merci !</h1>
        <p>Vous allez recevoir une confirmation par email, avec le lien de la visio. Pour tirer le meilleur de nos 30 minutes, pensez à la tâche qui vous prend le plus de temps chaque semaine : c’est par là que nous commencerons.</p>
        <div class="hero-cta">
            <a class="btn btn-primary" href="/cas-usage">Voir des cas d’usage</a>
            <a class="btn btn-ghost" href="/">Retour à l’accueil</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
