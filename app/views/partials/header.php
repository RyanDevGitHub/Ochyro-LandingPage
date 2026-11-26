<?php
$navCurrent = $page['path'] ?? '/';
$rdvHref = $navCurrent === '/' ? '#rdv' : '/contact#rdv';
$nav = [
    '/services'   => 'Ce qu’on automatise',
    '/cas-usage'  => 'Cas d’usage',
    '/#methode'   => 'Méthode',
    '/#faq'       => 'FAQ',
];
?>
<body>
<a class="skip-link" href="#contenu">Aller au contenu</a>

<header class="site-header">
    <div class="container header-inner">
        <a href="/" class="brand" aria-label="Ochyro — accueil">
            <span class="brand-mark"><img src="/assets/imgs/ochyro_logo_no_background.svg" alt="" width="40" height="40"></span>
            <span class="brand-text">
                <strong>Ochyro</strong>
                <small>Automatisation IA</small>
            </span>
        </a>

        <nav class="nav-desktop" aria-label="Navigation principale">
            <?php foreach ($nav as $href => $label): ?>
                <a href="<?= e($href) ?>"<?= $href === $navCurrent ? ' aria-current="page"' : '' ?>><?= e($label) ?></a>
            <?php endforeach; ?>
        </nav>

        <div class="header-actions">
            <a class="header-phone" href="tel:<?= e(site('phone_href')) ?>"><?= icon('phone-linear', 18) ?><?= e(site('phone_label')) ?></a>
            <a class="btn btn-primary btn-sm" href="<?= e($rdvHref) ?>" data-track="cta_header">Appel gratuit</a>
            <button class="menu-btn" id="menuBtn" type="button" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="mobileMenu">
                <?= icon('hamburger-menu-linear', 22) ?>
            </button>
        </div>
    </div>

    <div class="nav-mobile" id="mobileMenu" hidden>
        <div class="container">
            <?php foreach ($nav as $href => $label): ?>
                <a href="<?= e($href) ?>"><?= e($label) ?></a>
            <?php endforeach; ?>
            <a href="<?= e($rdvHref) ?>" class="btn btn-primary btn-block" data-track="cta_mobile_menu">Réserver mon appel gratuit</a>
        </div>
    </div>
</header>

<main id="contenu">
