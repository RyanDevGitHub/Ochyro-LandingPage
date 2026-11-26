# Ochyro — site vitrine « Automatisation IA »

Site de vente de services d'automatisation par l'IA. Objectif unique : obtenir des appels
découverte (Calendly) et des demandes de devis gratuit (formulaire).

## Structure

- `public/index.php` — point d'entrée et routes (+ redirections 301 des anciennes pages IT)
- `app/config.php` — coordonnées et lien Calendly (un seul endroit à modifier)
- `app/content.php` — contenu éditorial : domaines d'automatisation, cas d'usage, FAQ
- `app/views/*.php` — pages ; `app/views/partials/` — head, header, footer, bloc de réservation
- `app/controllers/` — `PageController`, `ContactController`, `BrevoService` (envoi des emails)
- `public/assets/css/ochyro.css`, `public/assets/js/site.js` — styles et scripts (aucune étape de build)

## Lancer en local

```bash
php -S 127.0.0.1:8000 -t public public/router.php
```

## Configuration (`.env`, non versionné)

`BREVO_API_KEY`, et optionnellement `BREVO_SENDER_EMAIL`, `BREVO_SENDER_NAME`, `BREVO_CONTACT_RECIPIENT`.

## Déploiement

Push sur `main` : le workflow `.github/workflows/cd.yml` construit l'image Docker et déploie sur le VPS.
