<?php
$content = require __DIR__ . '/../content.php';

$faqSchema = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map(static fn(array $f): array => [
        '@type'          => 'Question',
        'name'           => $f['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ], $content['faq']),
];

$page = [
    'title'       => 'Automatisation IA pour entreprises — Audit et devis gratuits | Ochyro',
    'description' => 'Quelles tâches de votre entreprise peuvent être automatisées avec l’IA ? Ochyro analyse votre workflow lors d’un appel gratuit de 30 minutes et vous remet un devis gratuit.',
    'path'        => '/',
    'schema'      => [
        [
            '@context' => 'https://schema.org',
            '@type'    => 'WebSite',
            'name'     => 'Ochyro',
            'url'      => site('base_url'),
        ],
        $faqSchema,
    ],
];
require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>

<!-- HERO -->
<section class="hero">
    <div class="container hero-grid">
        <div>
            <span class="eyebrow">Automatisation IA sur mesure</span>
            <h1>Vos tâches répétitives, <em>automatisées par l’IA.</em></h1>
            <p class="hero-lead">
                Vous perdez des heures en emails, saisies et relances ? En 30 minutes, nous identifions
                quelles parties de votre workflow sont automatisables avec l’IA, puis nous vous remettons
                un <strong>devis gratuit</strong>.
            </p>
            <div class="hero-cta">
                <a class="btn btn-primary btn-lg" href="#rdv" data-track="cta_hero_primary">
                    <?= icon('calendar-linear', 22) ?>Réserver mon appel gratuit
                </a>
                <a class="btn btn-ghost" href="#automatisable" data-track="cta_hero_secondary">
                    Voir ce qu’on automatise
                </a>
            </div>
            <p class="hero-note">Gratuit · 30 minutes · Sans engagement</p>
        </div>

        <aside class="flow-card" aria-label="Exemple de workflow automatisé">
            <span class="flow-tag">Exemple</span>
            <p class="flow-title">Une demande client, de l’arrivée à la réponse</p>
            <ol class="flow-steps">
                <li class="flow-step">
                    <span class="flow-ico"><?= icon('letter-linear', 22) ?></span>
                    <div><strong>Un email arrive</strong><span>Demande de devis dans votre boîte mail</span></div>
                </li>
                <li class="flow-step ai">
                    <span class="flow-ico"><?= icon('cpu-bolt-linear', 22) ?></span>
                    <div><strong>L’IA lit et structure</strong><span>Besoin, budget, délai : les informations sont extraites</span></div>
                </li>
                <li class="flow-step ai">
                    <span class="flow-ico"><?= icon('database-linear', 22) ?></span>
                    <div><strong>Votre CRM se met à jour</strong><span>Fiche créée, tâche assignée, sans saisie</span></div>
                </li>
                <li class="flow-step">
                    <span class="flow-ico"><?= icon('user-check-linear', 22) ?></span>
                    <div><strong>Vous validez la réponse</strong><span>Un brouillon est prêt, vous gardez la main</span></div>
                </li>
            </ol>
            <p class="flow-foot"><?= icon('clock-circle-linear', 20, 'accent') ?>Moins de saisie, plus de temps pour vos clients.</p>
        </aside>
    </div>
</section>

<!-- RÉASSURANCE -->
<section class="trust" aria-label="Nos engagements">
    <div class="container trust-grid">
        <div class="trust-item"><?= icon('check-circle-linear', 26) ?>Appel découverte gratuit</div>
        <div class="trust-item"><?= icon('check-circle-linear', 26) ?>Devis chiffré, sans engagement</div>
        <div class="trust-item"><?= icon('check-circle-linear', 26) ?>Compatible avec vos outils actuels</div>
        <div class="trust-item"><?= icon('check-circle-linear', 26) ?>Validation humaine aux étapes clés</div>
    </div>
</section>

<!-- PROBLÈME -->
<section class="section section-dark">
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">Le constat</span>
            <h2>Chaque semaine, votre équipe perd du temps sur des tâches que l’IA sait faire.</h2>
            <p>Ce temps-là n’est pas consacré à vos clients, à vos projets ni à votre croissance.</p>
        </div>
        <div class="grid grid-2">
            <div class="pain reveal"><?= icon('inbox-linear', 28) ?><div><strong>Des boîtes mail qui débordent</strong><span>Trier, répondre, relancer : le même travail chaque jour.</span></div></div>
            <div class="pain reveal"><?= icon('document-text-linear', 28) ?><div><strong>Des ressaisies à répétition</strong><span>Copier des données d’un document vers un outil, puis vers un autre.</span></div></div>
            <div class="pain reveal"><?= icon('refresh-linear', 28) ?><div><strong>Des relances oubliées</strong><span>Prospects, paiements, documents manquants : tout dépend de la mémoire de chacun.</span></div></div>
            <div class="pain reveal"><?= icon('chart-2-linear', 28) ?><div><strong>Des rapports compilés à la main</strong><span>Des chiffres dispersés qu’il faut rassembler avant de pouvoir décider.</span></div></div>
        </div>
    </div>
</section>

<!-- CE QUI EST AUTOMATISABLE -->
<section class="section" id="automatisable">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow">Ce qu’on automatise</span>
            <h2>Quelle partie de votre workflow est automatisable avec l’IA ?</h2>
            <p>Voici les huit domaines où nous intervenons le plus souvent. Votre appel gratuit sert à repérer lesquels s’appliquent à votre activité.</p>
        </div>
        <div class="grid grid-4">
            <?php foreach ($content['areas'] as $area): ?>
                <article class="card reveal">
                    <div class="ico"><?= icon($area['icon'], 26) ?></div>
                    <h3><?= e($area['title']) ?></h3>
                    <p><?= e($area['summary']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="hero-cta" style="justify-content:center;margin-top:44px">
            <a class="btn btn-ghost" href="/services">Voir le détail de chaque domaine</a>
            <a class="btn btn-primary" href="#rdv" data-track="cta_areas">Identifier mes automatisations</a>
        </div>
    </div>
</section>

<!-- BON CANDIDAT -->
<section class="section section-white">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow">En toute franchise</span>
            <h2>Tout ne doit pas être automatisé. Nous vous le disons.</h2>
            <p>Une bonne automatisation fait gagner du temps sans créer de risque. Voici comment nous faisons le tri.</p>
        </div>
        <div class="fit-grid">
            <div class="fit good reveal">
                <h3><?= icon('check-circle-linear', 26, 'accent') ?>Excellents candidats</h3>
                <ul>
                    <li><?= icon('check-circle-linear', 20) ?>Tâches répétitives, qui reviennent chaque jour ou chaque semaine</li>
                    <li><?= icon('check-circle-linear', 20) ?>Processus qui suivent des règles claires</li>
                    <li><?= icon('check-circle-linear', 20) ?>Volume suffisant pour que le gain de temps compte</li>
                    <li><?= icon('check-circle-linear', 20) ?>Données déjà numériques : emails, PDF, tableurs, logiciels</li>
                </ul>
            </div>
            <div class="fit warn reveal">
                <h3><?= icon('shield-check-linear', 26) ?>À encadrer, ou à garder humain</h3>
                <ul>
                    <li><?= icon('shield-check-linear', 20) ?>Décisions à fort enjeu financier, juridique ou humain</li>
                    <li><?= icon('shield-check-linear', 20) ?>Relations clients sensibles qui demandent de l’empathie</li>
                    <li><?= icon('shield-check-linear', 20) ?>Tâches rares, pour lesquelles l’automatisation ne serait pas rentable</li>
                    <li><?= icon('shield-check-linear', 20) ?>Processus encore flous : mieux vaut d’abord les clarifier</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- MÉTHODE -->
<section class="section" id="methode">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow">Notre méthode</span>
            <h2>De l’appel gratuit à l’automatisation en production.</h2>
            <p>Un parcours simple, où vous savez toujours ce que vous obtenez avant de vous engager.</p>
        </div>
        <div class="steps">
            <div class="step highlight reveal">
                <h3>Appel découverte</h3>
                <p>30 minutes pour comprendre votre façon de travailler et repérer les tâches qui vous pèsent.</p>
                <span class="badge">Gratuit</span>
            </div>
            <div class="step highlight reveal">
                <h3>Cartographie &amp; devis</h3>
                <p>Nous classons les automatisations possibles par impact et par effort, et vous remettons un devis chiffré.</p>
                <span class="badge">Gratuit</span>
            </div>
            <div class="step reveal">
                <h3>Mise en place</h3>
                <p>Nous construisons, testons avec vos données et formons vos équipes. Une première version utilisable d’abord.</p>
            </div>
            <div class="step reveal">
                <h3>Suivi &amp; amélioration</h3>
                <p>Nous surveillons le fonctionnement, corrigeons et faisons évoluer l’automatisation avec votre activité.</p>
            </div>
        </div>
    </div>
</section>

<!-- DEVIS GRATUIT -->
<section class="section section-dark" id="devis">
    <div class="container split">
        <div class="reveal">
            <span class="eyebrow">Devis gratuit</span>
            <h2>Ce que vous recevez après l’appel.</h2>
            <p class="hero-lead" style="color:rgba(245,242,234,.8)">
                Pas de proposition floue : un document clair qui vous permet de décider en connaissance de cause.
            </p>
            <ul class="checks">
                <li><?= icon('check-circle-linear', 22) ?>La liste des tâches automatisables dans votre activité</li>
                <li><?= icon('check-circle-linear', 22) ?>Un classement par impact et par facilité de mise en œuvre</li>
                <li><?= icon('check-circle-linear', 22) ?>Les outils et solutions recommandés</li>
                <li><?= icon('check-circle-linear', 22) ?>Un chiffrage précis et un planning</li>
                <li><?= icon('check-circle-linear', 22) ?>Une estimation du temps que vous pourriez gagner</li>
            </ul>
            <div class="hero-cta">
                <a class="btn btn-cyan btn-lg" href="#rdv" data-track="cta_devis">
                    <?= icon('calendar-linear', 22) ?>Obtenir mon devis gratuit
                </a>
            </div>
        </div>

        <div class="deliverable reveal" aria-label="Exemple de présentation du devis">
            <h3>Cartographie de vos automatisations</h3>
            <p class="sub">Exemple de présentation — le contenu est propre à chaque entreprise.</p>
            <div class="d-row"><b>Tri et réponse aux emails entrants</b><span class="pill hi">Impact fort</span><span class="pill hi">Simple</span></div>
            <div class="d-row"><b>Saisie des factures fournisseurs</b><span class="pill hi">Impact fort</span><span class="pill mid">Moyen</span></div>
            <div class="d-row"><b>Relances clients automatiques</b><span class="pill mid">Impact moyen</span><span class="pill hi">Simple</span></div>
            <div class="d-row"><b>Reporting hebdomadaire</b><span class="pill mid">Impact moyen</span><span class="pill hi">Simple</span></div>
            <div class="d-row"><b>Décision de remboursement</b><span class="pill lo">À garder humain</span><span class="pill lo">—</span></div>
            <div class="d-foot"><span>Devis chiffré &amp; planning</span><span>Inclus</span></div>
            <p class="d-note">Illustration indicative. Aucun chiffre n’est garanti avant l’analyse de votre situation.</p>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section" id="faq">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow">Questions fréquentes</span>
            <h2>Vous vous demandez peut-être…</h2>
        </div>
        <div class="faq reveal">
            <?php foreach ($content['faq'] as $item): ?>
                <details>
                    <summary><?= e($item['q']) ?></summary>
                    <p><?= e($item['a']) ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- RÉSERVATION -->
<section class="section section-white" id="reserver">
    <div class="container">
        <?php require __DIR__ . '/partials/booking.php'; ?>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
