# Séquence email post-lead magnet (Brevo)

Séquence à configurer dans Brevo (workflow → automation) déclenchée à l'inscription via le formulaire `/lead-magnet` (checklist IT cabinet comptable).

Liste cible Brevo : `lead-magnet-cabinet-comptable`.
Tag à l'inscription : `lead_source=lead_magnet`.

---

## Email 1 — J+0 (immédiat)

- **Objet** : Voici votre checklist IT pour cabinets comptables
- **Pre-header** : 12 points pour mesurer votre risque IT en 5 minutes.
- **Objectif** : livrer la promesse, créer la première interaction de confiance.
- **Contenu clé** :
  - Lien direct (PDF + version HTML) vers la checklist
  - Une phrase qui rappelle pourquoi elle a été créée (concrétude > théorie)
  - Signature humaine d'un membre d'Ochyro
- **CTA** : *Télécharger la checklist*
- **CTA secondaire** : *Réserver un échange de 30 min*

## Email 2 — J+2

- **Objet** : Le risque qui revient le plus souvent dans les cabinets comptables
- **Pre-header** : Spoiler : ce n'est pas le ransomware.
- **Objectif** : démontrer l'expertise sectorielle, créer un déclic mental.
- **Contenu clé** :
  - Le vrai risque #1 = sauvegardes non testées (story courte d'un cabinet fictif)
  - 3 questions concrètes à poser à son prestataire actuel
- **CTA** : *Tester ma sauvegarde gratuitement (audit)*

## Email 3 — J+5

- **Objet** : Conformité RGPD article 32 — la question piège du contrôle CNIL
- **Pre-header** : Saurez-vous présenter vos preuves ?
- **Objectif** : mettre en lumière la conformité comme un manque silencieux.
- **Contenu clé** :
  - Ce que la CNIL demande concrètement (registre, journaux, notification)
  - 2 questions tests
  - Lien vers la page `/cybersecurite`
- **CTA** : *Diagnostic conformité RGPD*

## Email 4 — J+10

- **Objet** : Avant Ochyro / Avec Ochyro — un cabinet vous parle
- **Pre-header** : Ce qui change concrètement quand on confie son IT à un MSP spécialisé.
- **Objectif** : projection émotionnelle + dernier appel à l'action.
- **Contenu clé** :
  - Format avant/après chiffré (Cegid down → supervision 24/7, sauvegardes testées)
  - Engagement : audit gratuit, rapport PDF sous 48 h
- **CTA** : *Réserver mon audit gratuit*
- **CTA secondaire** : *Appeler 07 57 82 04 40*

---

## Règles transverses

- Désinscription en un clic dans chaque email (Brevo : `{{unsubscribe}}` token).
- Pas plus d'un email tous les 2 jours.
- Si l'inscrit prend rendez-vous Calendly → exclusion automatique de la séquence (tag `appointment_booked`).
- Si un email est ouvert mais non cliqué après J+5 → ajouter un email J+7 court (rappel CTA).
- Si aucun click sur 4 emails → tag `cold` puis nurturing mensuel.

## Variables Brevo utilisées

- `{{contact.FIRSTNAME}}` (optionnel — fallback : "Bonjour")
- `{{contact.EMAIL}}`
- `{{contact.LEAD_SOURCE}}`

## À configurer côté ops

- [ ] Créer la liste `lead-magnet-cabinet-comptable`
- [ ] Importer les 4 templates dans Brevo
- [ ] Mettre en place le workflow (déclencheur : ajout à la liste)
- [ ] Tester la séquence avec un email interne
- [ ] Brancher Calendly → tag `appointment_booked` (via webhook Brevo ou Zapier)
