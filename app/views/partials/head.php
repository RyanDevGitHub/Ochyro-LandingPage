<?php
/**
 * <head> commun. Variables attendues dans $page :
 *  title, description, path (ex: "/services"), [robots], [schema => list<array>]
 */
$base     = site('base_url');
$canon    = $base . ($page['path'] === '/' ? '/' : $page['path']);
$robots   = $page['robots'] ?? 'index, follow';
$ogImage  = $base . '/assets/imgs/ochyro_logo_no_background.svg';

$organization = [
    '@context'    => 'https://schema.org',
    '@type'       => 'ProfessionalService',
    '@id'         => $base . '/#organization',
    'name'        => 'Ochyro',
    'url'         => $base,
    'logo'        => $ogImage,
    'image'       => $ogImage,
    'description' => "Ochyro conçoit et déploie des automatisations IA pour les entreprises : emails, documents, CRM, reporting. Audit du workflow et devis gratuits.",
    'telephone'   => '+33757820440',
    'email'       => site('email'),
    'address'     => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => '33 Rue Montera',
        'addressLocality' => 'Paris',
        'postalCode'      => '75012',
        'addressCountry'  => 'FR',
    ],
    'areaServed'  => ['@type' => 'Country', 'name' => 'France'],
    'knowsAbout'  => ['Automatisation IA', 'Automatisation de workflows', 'Agents IA', 'Traitement automatique de documents'],
    'sameAs'      => [site('linkedin_url')],
];
$schemas = array_merge([$organization], $page['schema'] ?? []);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page['title']) ?></title>
    <meta name="description" content="<?= e($page['description']) ?>">
    <meta name="robots" content="<?= e($robots) ?>">
    <script>document.documentElement.classList.add('js');</script>
    <meta name="indexnow-key" content="d8f3a1b2c9e4f7a6">
    <meta name="theme-color" content="#22304a">
    <link rel="canonical" href="<?= e($canon) ?>">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:site_name" content="Ochyro">
    <meta property="og:title" content="<?= e($page['title']) ?>">
    <meta property="og:description" content="<?= e($page['description']) ?>">
    <meta property="og:url" content="<?= e($canon) ?>">
    <meta property="og:image" content="<?= e($ogImage) ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?= e($page['title']) ?>">
    <meta name="twitter:description" content="<?= e($page['description']) ?>">
    <meta name="twitter:image" content="<?= e($ogImage) ?>">

    <meta http-equiv="Content-Security-Policy" content="
        default-src 'self';
        script-src 'self' 'unsafe-inline' https://www.googletagmanager.com https://assets.calendly.com https://cdn.jsdelivr.net https://code.iconify.design https://eu-assets.i.posthog.com https://us-assets.i.posthog.com;
        style-src 'self' 'unsafe-inline' https://assets.calendly.com https://cdn.jsdelivr.net https://fonts.googleapis.com;
        font-src 'self' https://fonts.gstatic.com;
        img-src 'self' data: https://assets.calendly.com https://www.google.com https://googleads.g.doubleclick.net https://www.googleadservices.com https://*.google.com;
        connect-src 'self' https://api.iconify.design https://api.simplesvg.com https://api.unisvg.com https://eu.i.posthog.com https://eu-assets.i.posthog.com https://us.i.posthog.com https://us-assets.i.posthog.com https://www.google.com https://googleads.g.doubleclick.net https://www.googleadservices.com https://*.google.com;
        frame-src https://calendly.com;
        upgrade-insecure-requests;">

    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/imgs/favicon-32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/imgs/favicon-192.png">
    <link rel="apple-touch-icon" sizes="192x192" href="/assets/imgs/favicon-192.png">
    <link rel="manifest" href="/manifest.json">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;700;800&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="/assets/css/ochyro.css?v=<?= (string) @filemtime(__DIR__ . '/../../../public/assets/css/ochyro.css') ?>">
    <link rel="stylesheet" href="https://assets.calendly.com/assets/external/widget.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.9.1/dist/cookieconsent.css" media="print" onload="this.media='all'">

<?php foreach ($schemas as $schema): ?>
    <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
<?php endforeach; ?>

    <script src="https://code.iconify.design/iconify-icon/2.2.0/iconify-icon.min.js" defer></script>
    <script src="https://assets.calendly.com/assets/external/widget.js" async></script>
    <script>
        !function (t, e) { var o, n, p, r; e.__SV || (window.posthog = e, e._i = [], e.init = function (i, s, a) { function g(t, e) { var o = e.split("."); 2 == o.length && (t = t[o[0]], e = o[1]), t[e] = function () { t.push([e].concat(Array.prototype.slice.call(arguments, 0))) } } (p = t.createElement("script")).type = "text/javascript", p.async = !0, p.src = s.api_host.replace(".i.posthog.com", "-assets.i.posthog.com") + "/static/array.js", (r = t.getElementsByTagName("script")[0]).parentNode.insertBefore(p, r); var u = e; for (void 0 !== a ? u = e[a] = [] : a = "posthog", u.people = u.people || [], u.toString = function (t) { var e = "posthog"; return "posthog" !== a && (e += "." + a), t || (e += " (stub)"), e }, u.people.toString = function () { return u.toString(1) + ".people (stub)" }, o = "init capture register register_once register_for_session unregister opt_out_capturing has_opted_out_capturing opt_in_capturing reset isFeatureEnabled getFeatureFlag getFeatureFlagPayload reloadFeatureFlags group identify setPersonProperties setPersonPropertiesForFlags resetPersonPropertiesForFlags setGroupPropertiesForFlags resetGroupPropertiesForFlags resetGroups onFeatureFlags addFeatureFlagsHandler onSessionId getSurveys getActiveMatchingSurveys renderSurvey canRenderSurvey getNextSurveyStep".split(" "), n = 0; n < o.length; n++)g(u, o[n]); e._i.push([i, s, a]) }, e.__SV = 1) }(document, window.posthog || []);
        posthog.init('phc_aYqkIxpEvAKdnDFVRG5HVHgFH9HRSuAKFkagiuhcSNq', {
            api_host: 'https://us.i.posthog.com',
            defaults: '2026-01-30'
        });
    </script>
    <!-- Google tag (gtag.js) avec Consent Mode v2 : tout est refusé jusqu'au choix du visiteur -->
    <script>
        (function () {
            var host = window.location.hostname;
            var isLocal = host === 'localhost' || host === '127.0.0.1' || host === '::1';
            var isFramed = false;
            try { isFramed = window.top !== window.self; } catch (e) { isFramed = true; }
            if (isLocal || isFramed) { return; }

            window.dataLayer = window.dataLayer || [];
            window.gtag = function () { dataLayer.push(arguments); };
            gtag('consent', 'default', {
                ad_storage: 'denied',
                ad_user_data: 'denied',
                ad_personalization: 'denied',
                analytics_storage: 'denied',
                functionality_storage: 'denied',
                personalization_storage: 'denied',
                security_storage: 'granted',
                wait_for_update: 500
            });

            var s = document.createElement('script');
            s.async = true;
            s.src = 'https://www.googletagmanager.com/gtag/js?id=AW-17987750029';
            document.head.appendChild(s);
            gtag('js', new Date());
            gtag('config', 'AW-17987750029');
        })();
    </script>
</head>
