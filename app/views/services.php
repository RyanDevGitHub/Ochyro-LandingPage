<?php
$content = require __DIR__ . '/../content.php';
$page = [
    'title'       => 'Ce qu’on automatise avec l’IA : emails, documents, CRM, reporting | Ochyro',
    'description' => 'Emails, saisie de documents, relances commerciales, reporting, back-office, assistants internes : découvrez les parties de votre workflow que l’IA peut automatiser. Devis gratuit.',
    'path'        => '/services',
    'schema'      => [[
        '@context'        => 'https://schema.org',
        '@type'           => 'ItemList',
        'name'            => 'Domaines d’automatisation IA proposés par Ochyro',
        'itemListElement' => array_map(static fn(array $a, int $i): array => [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $a['title'],
        ], $content['areas'], array_keys($content['areas'])),
    ]],
];
require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>

<section class="hero" style="padding-bottom:56px">
    <div class="container">
        <span class="eyebrow">Ce qu’on automatise</span>
        <h1 style="max-width:900px">Les parties de votre workflow que l’IA peut prendre en charge.</h1>
        <p class="hero-lead" style="max-width:760px">
            Huit domaines, des exemples concrets, et une règle simple : nous n’automatisons que ce qui vous fait
            réellement gagner du temps, avec un humain dans la boucle quand c’est nécessaire.
        </p>
        <div class="hero-cta">
            <a class="btn btn-primary btn-lg" href="/contact#rdv" data-track="cta_services_hero">
                <?= icon('calendar-linear', 22) ?>Réserver mon appel gratuit
            </a>
        </div>
        <p class="hero-note">Gratuit · 30 minutes · Devis offert</p>
    </div>
</section>

<section class="section-tight" style="padding-top:0">
    <div class="container">
        <div class="grid grid-2">
            <?php foreach ($content['areas'] as $area): ?>
                <article class="card reveal">
                    <div class="ico"><?= icon($area['icon'], 26) ?></div>
                    <h2 style="font-size:1.4rem"><?= e($area['title']) ?></h2>
                    <p><?= e($area['summary']) ?></p>
                    <ul class="mini">
                        <?php foreach ($area['points'] as $point): ?>
                            <li><?= icon('check-circle-linear', 18) ?><?= e($point) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="example"><b>Exemple :</b> <?= e($area['example']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-dark">
    <div class="container cta-band reveal">
        <h2 style="max-width:760px;margin:0 auto">Vous ne savez pas par où commencer ? C’est normal.</h2>
        <p class="hero-lead" style="margin:18px auto 0;color:rgba(245,242,234,.8)">
            Pendant l’appel gratuit, nous repérons ensemble les automatisations les plus rentables pour vous, puis nous vous remettons un devis.
        </p>
        <div class="hero-cta">
            <a class="btn btn-cyan btn-lg" href="/contact#rdv" data-track="cta_services_bottom">
                <?= icon('calendar-linear', 22) ?>Réserver mon appel gratuit
            </a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
