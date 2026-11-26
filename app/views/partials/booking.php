<?php
/**
 * Bloc de prise de rendez-vous (Calendly). Variables optionnelles :
 *  $bookingTitle, $bookingLead
 */
$bookingTitle ??= 'Réservez votre appel gratuit de 30 minutes';
$bookingLead  ??= 'On passe en revue votre façon de travailler, on repère ce qui est automatisable avec l’IA et on vous remet ensuite un devis gratuit.';
?>
<div class="booking" id="rdv">
    <div>
        <span class="eyebrow">Appel découverte</span>
        <h2><?= e($bookingTitle) ?></h2>
        <p class="hero-lead"><?= e($bookingLead) ?></p>
        <ul class="checks">
            <li><?= icon('check-circle-linear', 22) ?>30 minutes en visio ou par téléphone</li>
            <li><?= icon('check-circle-linear', 22) ?>Aucune préparation technique nécessaire</li>
            <li><?= icon('check-circle-linear', 22) ?>Un devis gratuit et chiffré à la clé</li>
            <li><?= icon('check-circle-linear', 22) ?>Sans engagement, sans relance agressive</li>
        </ul>
        <div class="contact-lines">
            <a href="tel:<?= e(site('phone_href')) ?>"><?= icon('phone-linear', 22) ?>Préférez-vous appeler ? <?= e(site('phone_label')) ?></a>
        </div>
    </div>

    <div class="booking-panel">
        <div class="only-mobile booking-fallback">
            <button type="button" class="btn btn-primary btn-lg btn-block" data-calendly data-calendly-url="<?= e(site('calendly_url')) ?>" data-track="cta_calendly_popup">
                <?= icon('calendar-linear', 22) ?>Choisir un créneau
            </button>
            <p>Le calendrier s’ouvre en plein écran.</p>
        </div>
        <div class="only-desktop">
            <div class="calendly-inline-widget" data-url="<?= e(site('calendly_url')) ?>"></div>
            <p class="booking-alt">Le calendrier ne s’affiche pas ? <a href="<?= e(site('calendly_url')) ?>" target="_blank" rel="noopener noreferrer">Ouvrez-le dans un nouvel onglet</a> ou appelez le <a href="tel:<?= e(site('phone_href')) ?>"><?= e(site('phone_label')) ?></a>.</p>
        </div>
    </div>
</div>
