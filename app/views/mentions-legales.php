<?php
$page = [
    'title'       => 'Mentions légales | Ochyro',
    'description' => 'Mentions légales du site ochyro.net édité par Ochyro IT.',
    'path'        => '/mentions-legales',
];
require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>

<div class="container prose-page">
    <article class="prose">
        <h1>Mentions légales</h1>
        <p class="updated">Dernière mise à jour : avril 2026.</p>

        <section>
                        <h2>1. Éditeur du site</h2>
                        <p>
                            Le site <strong>ochyro.net</strong> est édité par&nbsp;:<br>
                            <strong>Ochyro IT</strong><br>
                            Forme juridique&nbsp;: <em>{{forme juridique à compléter — SAS / SARL / EI}}</em><br>
                            Capital social&nbsp;: <em>{{capital social à compléter}}</em><br>
                            Siège social&nbsp;: 33 Rue Montera, 75012 Paris, France<br>
                            SIRET&nbsp;: <em>{{numéro SIRET à compléter}}</em><br>
                            RCS&nbsp;: <em>{{ville et n° RCS à compléter}}</em><br>
                            TVA intracommunautaire&nbsp;: <em>{{numéro TVA à compléter}}</em><br>
                            Téléphone&nbsp;: <a href="tel:+33757820440">07 57 82 04 40</a><br>
                            E-mail&nbsp;: <a href="mailto:contact@ochyro.net">contact@ochyro.net</a>
                        </p>
                    </section>

        <section>
                        <h2>2. Directeur de la publication</h2>
                        <p>
                            Le directeur de la publication est <em>{{nom du dirigeant à compléter}}</em>, en sa qualité de représentant légal d'Ochyro IT.
                        </p>
                    </section>

        <section>
                        <h2>3. Hébergeur</h2>
                        <p>
                            Le site est hébergé sur un serveur opéré par&nbsp;:<br>
                            <em>{{nom de l'hébergeur — par ex. OVHcloud, Hetzner, Scaleway}}</em><br>
                            <em>{{adresse complète de l'hébergeur}}</em><br>
                            Téléphone&nbsp;: <em>{{téléphone hébergeur}}</em>
                        </p>
                    </section>

        <section>
                        <h2>4. Propriété intellectuelle</h2>
                        <p>
                            L'ensemble du contenu du site (textes, illustrations, logos, marques, images, vidéos) est la propriété
                            exclusive d'Ochyro IT ou de ses partenaires, et est protégé par le Code de la propriété intellectuelle.
                            Toute reproduction, représentation, modification ou exploitation, totale ou partielle, du site et de ses
                            contenus sans autorisation écrite préalable est interdite et susceptible de constituer une contrefaçon
                            au sens des articles L.335-2 et suivants du Code de la propriété intellectuelle.
                        </p>
                    </section>

        <section>
                        <h2>5. Responsabilité</h2>
                        <p>
                            Ochyro IT s'efforce d'assurer l'exactitude et la mise à jour des informations diffusées sur le site, dont elle
                            se réserve le droit de corriger le contenu à tout moment et sans préavis. Toutefois, Ochyro IT ne peut
                            garantir l'exactitude, la précision ou l'exhaustivité des informations mises à disposition. La responsabilité
                            d'Ochyro IT ne saurait être engagée en cas de dommage direct ou indirect résultant de l'utilisation du site.
                        </p>
                    </section>

        <section>
                        <h2>6. Liens hypertextes</h2>
                        <p>
                            Le site peut contenir des liens vers des sites tiers. Ochyro IT n'exerce aucun contrôle sur ces sites et
                            décline toute responsabilité quant à leur contenu.
                        </p>
                    </section>

        <section>
                        <h2>7. Données personnelles</h2>
                        <p>
                            Le traitement des données personnelles collectées via le site est détaillé dans notre
                            <a href="/politique-de-confidentialite">Politique de confidentialité</a>.
                        </p>
                    </section>

        <section>
                        <h2>8. Droit applicable</h2>
                        <p>
                            Le présent site et les présentes mentions légales sont soumis au droit français. En cas de litige, et à
                            défaut d'accord amiable, les tribunaux français seront seuls compétents.
                        </p>
                    </section>
    </article>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
