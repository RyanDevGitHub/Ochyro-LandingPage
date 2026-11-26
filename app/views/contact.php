<?php
$page = [
    'title'       => 'Contact — Réservez votre appel gratuit | Ochyro',
    'description' => 'Réservez un appel gratuit de 30 minutes pour identifier ce qui est automatisable avec l’IA dans votre entreprise, ou écrivez-nous. Devis gratuit et sans engagement.',
    'path'        => '/contact',
    'schema'      => [[
        '@context' => 'https://schema.org',
        '@type'    => 'ContactPage',
        'name'     => 'Contact Ochyro',
        'url'      => site('base_url') . '/contact',
    ]],
];
require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>

<section class="section" style="padding-bottom:48px">
    <div class="container">
        <?php
        $bookingTitle = 'Réservez votre appel gratuit de 30 minutes';
        require __DIR__ . '/partials/booking.php';
        ?>
    </div>
</section>

<section class="section section-white" id="ecrire">
    <div class="container booking">
        <div>
            <span class="eyebrow">Plutôt par écrit ?</span>
            <h2>Décrivez-nous votre besoin.</h2>
            <p class="hero-lead">Quelques lignes suffisent : la tâche qui vous prend du temps, les outils que vous utilisez. Nous revenons vers vous avec une première analyse.</p>
            <div class="contact-lines">
                <a href="mailto:<?= e(site('email')) ?>"><?= icon('letter-linear', 22) ?><?= e(site('email')) ?></a>
                <a href="tel:<?= e(site('phone_href')) ?>"><?= icon('phone-linear', 22) ?><?= e(site('phone_label')) ?></a>
            </div>
        </div>

        <div class="form-card">
            <h2>Demander un devis gratuit</h2>
            <p>Sans engagement. Réponse personnalisée.</p>
            <form id="contact-form" novalidate>
                <div class="form-row">
                    <div class="field">
                        <label for="name">Nom <small>(requis)</small></label>
                        <input id="name" name="name" type="text" autocomplete="name" required>
                    </div>
                    <div class="field">
                        <label for="email">Email <small>(requis)</small></label>
                        <input id="email" name="email" type="email" autocomplete="email" required>
                    </div>
                </div>
                <div class="field">
                    <label for="phone">Téléphone <small>(facultatif)</small></label>
                    <input id="phone" name="phone" type="tel" autocomplete="tel">
                </div>
                <div class="field">
                    <label for="message">Quelle tâche aimeriez-vous automatiser ? <small>(requis)</small></label>
                    <textarea id="message" name="message" required placeholder="Ex. : nous passons plusieurs heures par semaine à saisir les factures reçues par email…"></textarea>
                </div>
                <div class="hp" aria-hidden="true">
                    <label for="website">Ne pas remplir</label>
                    <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                </div>
                <div class="field">
                    <button type="submit" id="contact-submit" class="btn btn-primary btn-block btn-lg" data-track="cta_contact_form">Envoyer ma demande</button>
                </div>
                <p class="form-legal">
                    Vos données servent uniquement à répondre à votre demande.
                    <a href="/politique-de-confidentialite">Politique de confidentialité</a>.
                </p>
                <div id="contact-success" class="alert alert-ok" role="status" hidden>Merci ! Votre message est bien envoyé. Nous revenons vers vous très vite.</div>
                <div id="contact-error" class="alert alert-err" role="alert" hidden></div>
            </form>
        </div>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
