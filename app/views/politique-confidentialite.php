<?php
$page = [
    'title'       => 'Politique de confidentialité | Ochyro',
    'description' => 'Politique de confidentialité du site ochyro.net : données collectées, finalités, durées de conservation et vos droits.',
    'path'        => '/politique-de-confidentialite',
];
require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>

<div class="container prose-page">
    <article class="prose">
        <h1>Politique de confidentialité</h1>
        <p class="updated">Dernière mise à jour : novembre 2026.</p>

        <section>
                        <h2>1. Responsable du traitement</h2>
                        <p>
                            Le responsable du traitement des données personnelles collectées via ce site est&nbsp;:<br>
                            <strong>Ochyro IT</strong>, 33 Rue Montera, 75012 Paris, France —
                            <a href="mailto:contact@ochyro.net">contact@ochyro.net</a>.
                        </p>
                    </section>

        <section>
                        <h2>2. Données collectées et finalités</h2>
                        <p>Nous collectons les données suivantes, uniquement pour les finalités indiquées&nbsp;:</p>
                        <ul>
                            <li>
                                <strong>Formulaire de contact</strong> — nom, e-mail, téléphone, message.<br>
                                <em>Finalité&nbsp;: répondre à votre demande (appel, devis). Base légale&nbsp;: intérêt légitime / mesures précontractuelles (RGPD art. 6.1.b et 6.1.f).</em>
                            </li>
                            <li>
                                <strong>Prise de rendez-vous Calendly</strong> — nom, e-mail, créneau, sujet.<br>
                                <em>Finalité&nbsp;: organiser et confirmer l'appel de découverte. Base légale&nbsp;: mesures précontractuelles.</em>
                            </li>
                            <li>
                                <strong>Mesure d'audience (PostHog)</strong> — données de navigation pseudonymisées.<br>
                                <em>Finalité&nbsp;: comprendre l'usage du site et l'améliorer. Base légale&nbsp;: consentement.</em>
                            </li>
                            <li>
                                <strong>Mesure publicitaire (Google Ads)</strong> — identifiants techniques.<br>
                                <em>Finalité&nbsp;: mesurer la performance des campagnes. Base légale&nbsp;: consentement.</em>
                            </li>
                        </ul>
                    </section>

        <section>
                        <h2>3. Destinataires des données</h2>
                        <p>
                            Vos données sont traitées par Ochyro IT et ses sous-traitants techniques&nbsp;:
                        </p>
                        <ul>
                            <li><strong>Brevo</strong> — envoi des e-mails transactionnels, dont les messages issus du formulaire de contact (UE).</li>
                            <li><strong>Calendly</strong> — gestion de la prise de rendez-vous (États-Unis, clauses contractuelles types).</li>
                            <li><strong>PostHog (UE)</strong> — mesure d'audience.</li>
                            <li><strong>Google (Google Ads)</strong> — mesure publicitaire (États-Unis, clauses contractuelles types).</li>
                            <li><strong>Hébergeur du site</strong> — <em>{{hébergeur à compléter — UE}}</em>.</li>
                        </ul>
                        <p>
                            Aucune donnée n'est revendue à des tiers.
                        </p>
                    </section>

        <section>
                        <h2>4. Durée de conservation</h2>
                        <ul>
                            <li>Demandes de contact non transformées en client&nbsp;: <strong>3 ans</strong> à compter du dernier échange.</li>
                            <li>Clients&nbsp;: durée du contrat + obligations légales (jusqu'à 10 ans pour la comptabilité).</li>
                            <li>Cookies&nbsp;: 13 mois maximum.</li>
                        </ul>
                    </section>

        <section>
                        <h2>5. Cookies</h2>
                        <p>
                            Le site utilise des cookies essentiels (fonctionnement, sécurité) et, après recueil de votre consentement,
                            des cookies de mesure d'audience et de mesure publicitaire (Consent Mode v2 de Google). Vous pouvez
                            modifier vos préférences à tout moment en cliquant sur le lien <em>« Gérer les cookies »</em> en pied de
                            page.
                        </p>
                    </section>

        <section>
                        <h2>6. Vos droits</h2>
                        <p>
                            Conformément au RGPD et à la loi <em>Informatique et Libertés</em>, vous disposez d'un droit d'accès,
                            de rectification, d'effacement, de limitation, d'opposition, et de portabilité de vos données, ainsi que
                            du droit de définir des directives post-mortem. Pour exercer ces droits&nbsp;: écrivez à
                            <a href="mailto:contact@ochyro.net">contact@ochyro.net</a>.
                            Vous pouvez également introduire une réclamation auprès de la
                            <a href="https://www.cnil.fr" target="_blank" rel="noopener noreferrer">CNIL</a>.
                        </p>
                    </section>

        <section>
                        <h2>7. Sécurité</h2>
                        <p>
                            Ochyro IT met en œuvre les mesures techniques et organisationnelles appropriées (chiffrement TLS,
                            contrôle des accès, journalisation) pour préserver la sécurité et la confidentialité
                            des données conformément à l'article 32 du RGPD.
                        </p>
                    </section>
    </article>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
