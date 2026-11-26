<?php
$content = require __DIR__ . '/../content.php';
$page = [
    'title'       => 'Cas d’usage d’automatisation IA : avant / après | Ochyro',
    'description' => 'Six scénarios types d’automatisation IA, avec ce qui change concrètement : demandes de devis, factures, leads, reporting, support, onboarding. Devis gratuit.',
    'path'        => '/cas-usage',
];
require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>

<section class="hero" style="padding-bottom:48px">
    <div class="container">
        <span class="eyebrow">Cas d’usage</span>
        <h1 style="max-width:900px">Ce qui change concrètement, avant et après.</h1>
        <p class="hero-lead" style="max-width:760px">
            Six scénarios types d’automatisation avec l’IA. Retrouvez-vous le vôtre ? Alors nous pouvons probablement vous aider.
        </p>
        <p class="hero-note" style="max-width:760px">
            Ces scénarios illustrent ce que nous mettons en place ; ce ne sont pas des références clients.
            Les gains dépendent de chaque contexte et sont estimés dans votre devis gratuit.
        </p>
    </div>
</section>

<section class="section-tight" style="padding-top:0">
    <div class="container cases">
        <?php foreach ($content['cases'] as $case): ?>
            <article class="case reveal">
                <header class="case-head">
                    <span class="tag"><?= e($case['tag']) ?></span>
                    <h2 style="font-size:1.55rem"><?= e($case['title']) ?></h2>
                </header>
                <div class="case-body">
                    <div class="case-col">
                        <h3 style="font-size:.8rem">Avant</h3>
                        <ul>
                            <?php foreach ($case['before'] as $line): ?>
                                <li><?= icon('close-circle-linear', 18) ?><?= e($line) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="case-col after">
                        <h3 style="font-size:.8rem">Avec l’automatisation</h3>
                        <ul>
                            <?php foreach ($case['after'] as $line): ?>
                                <li><?= icon('check-circle-linear', 18) ?><?= e($line) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <footer class="case-foot"><b>Ce qui reste humain :</b> <?= e($case['human']) ?></footer>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="section section-dark">
    <div class="container cta-band reveal">
        <h2 style="max-width:760px;margin:0 auto">Et dans votre entreprise, qu’est-ce qui pourrait être automatisé ?</h2>
        <p class="hero-lead" style="margin:18px auto 0;color:rgba(245,242,234,.8)">
            En 30 minutes, nous le déterminons ensemble. Le devis qui suit est gratuit.
        </p>
        <div class="hero-cta">
            <a class="btn btn-cyan btn-lg" href="/contact#rdv" data-track="cta_cases_bottom">
                <?= icon('calendar-linear', 22) ?>Réserver mon appel gratuit
            </a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
