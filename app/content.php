<?php

declare(strict_types=1);

/**
 * Contenu éditorial partagé entre l'accueil, /services, /cas-usage et le balisage SEO.
 * Aucun chiffre de performance n'est affiché : les gains sont estimés dans le devis,
 * au cas par cas.
 */
return [

    'areas' => [
        [
            'icon'    => 'inbox-linear',
            'title'   => 'Emails & demandes entrantes',
            'summary' => 'Fini le tri manuel de la boîte mail : l’IA lit, classe et prépare la suite.',
            'points'  => [
                'Tri et catégorisation automatiques des messages',
                'Brouillons de réponse prêts à valider',
                'Création des fiches et tâches dans vos outils',
            ],
            'example' => 'Une demande de devis arrive : l’IA en extrait les informations, crée la fiche dans votre CRM et prépare un brouillon de réponse que vous relisez.',
        ],
        [
            'icon'    => 'document-text-linear',
            'title'   => 'Documents & saisie de données',
            'summary' => 'Factures, devis, contrats, formulaires : les données sont extraites sans ressaisie.',
            'points'  => [
                'Lecture de PDF, scans et pièces jointes',
                'Export vers votre tableur, ERP ou logiciel métier',
                'Contrôles de cohérence et alertes sur les anomalies',
            ],
            'example' => 'Les factures fournisseurs reçues par email sont lues, les montants et références sont reportés dans votre outil, les cas douteux vous sont signalés.',
        ],
        [
            'icon'    => 'user-check-linear',
            'title'   => 'Leads & relances commerciales',
            'summary' => 'Vos prospects sont qualifiés et relancés au bon moment, sans effort.',
            'points'  => [
                'Qualification et priorisation des demandes',
                'Enrichissement des fiches contacts',
                'Relances et prises de rendez-vous automatisées',
            ],
            'example' => 'Chaque nouveau contact est analysé, classé par priorité et ajouté à votre CRM ; votre équipe ne traite que les plus prometteurs.',
        ],
        [
            'icon'    => 'chart-2-linear',
            'title'   => 'Reporting & tableaux de bord',
            'summary' => 'Les chiffres de plusieurs outils sont rassemblés et commentés automatiquement.',
            'points'  => [
                'Consolidation de vos sources de données',
                'Rapports hebdomadaires ou mensuels rédigés pour vous',
                'Alertes quand un indicateur sort de la normale',
            ],
            'example' => 'Chaque lundi, vous recevez un résumé clair de l’activité de la semaine avec les points d’attention, sans ouvrir un seul tableur.',
        ],
        [
            'icon'    => 'settings-linear',
            'title'   => 'Back-office & administratif',
            'summary' => 'Les procédures répétitives s’exécutent toutes seules, avec validation aux étapes clés.',
            'points'  => [
                'Onboarding de nouveaux clients ou collaborateurs',
                'Relances de paiement et de documents manquants',
                'Comptes rendus de réunion et suivi des actions',
            ],
            'example' => 'À la signature d’un devis, le dossier client, les accès, l’email de bienvenue et les premières tâches sont créés automatiquement.',
        ],
        [
            'icon'    => 'chat-round-dots-linear',
            'title'   => 'Assistant interne & support client',
            'summary' => 'Un assistant qui répond à partir de vos propres documents et procédures.',
            'points'  => [
                'Réponses aux questions fréquentes, 24h/24',
                'Base de connaissances interrogeable en langage naturel',
                'Passage de relais à un humain quand c’est nécessaire',
            ],
            'example' => 'Vos équipes posent une question sur une procédure ou une offre et obtiennent la réponse, avec le document source, en quelques secondes.',
        ],
        [
            'icon'    => 'widget-linear',
            'title'   => 'Contenu & marketing',
            'summary' => 'Production et déclinaison de contenus, toujours relus avant publication.',
            'points'  => [
                'Fiches produits et descriptions en volume',
                'Déclinaison d’un contenu sur plusieurs canaux',
                'Veille et synthèses de sources',
            ],
            'example' => 'Un article devient une série de publications adaptées à chaque réseau, que vous validez avant mise en ligne.',
        ],
        [
            'icon'    => 'link-round-linear',
            'title'   => 'Liaison entre vos outils',
            'summary' => 'Vos logiciels se parlent enfin : plus de double saisie ni de copier-coller.',
            'points'  => [
                'Connexion messagerie, CRM, ERP, tableurs, drive…',
                'Synchronisation des données dans les deux sens',
                'Aucun changement d’outils imposé',
            ],
            'example' => 'Une information saisie une seule fois se retrouve automatiquement partout où elle est utile.',
        ],
    ],

    'cases' => [
        [
            'tag'    => 'Équipe commerciale',
            'title'  => 'Traiter les demandes de devis entrantes',
            'before' => [
                'Les demandes arrivent par email, formulaire et téléphone',
                'Quelqu’un recopie les informations dans le CRM',
                'La réponse part quand la personne a le temps',
            ],
            'after'  => [
                'Toutes les demandes sont lues et structurées automatiquement',
                'La fiche CRM est créée et enrichie sans saisie',
                'Un brouillon de réponse est prêt, validé en un clic',
            ],
            'human'  => 'Vous validez chaque réponse et gardez la main sur le prix.',
        ],
        [
            'tag'    => 'Administratif & finance',
            'title'  => 'Gérer les factures fournisseurs',
            'before' => [
                'Les factures arrivent en PDF dans plusieurs boîtes mail',
                'Montants et références sont ressaisis à la main',
                'Les erreurs se découvrent en fin de mois',
            ],
            'after'  => [
                'Les factures sont collectées et lues automatiquement',
                'Les données sont envoyées dans votre outil de gestion',
                'Les anomalies sont signalées dès la réception',
            ],
            'human'  => 'Les cas douteux et les validations de paiement restent humains.',
        ],
        [
            'tag'    => 'Marketing & ventes',
            'title'  => 'Qualifier et relancer les leads',
            'before' => [
                'Tous les contacts sont traités de la même façon',
                'Les relances dépendent de la mémoire de chacun',
                'Les bons prospects refroidissent faute de suivi',
            ],
            'after'  => [
                'Chaque lead est analysé et priorisé automatiquement',
                'Les relances partent au bon moment, avec le bon message',
                'Votre équipe ne parle qu’aux contacts prometteurs',
            ],
            'human'  => 'Les échanges commerciaux importants restent entre vos mains.',
        ],
        [
            'tag'    => 'Direction',
            'title'  => 'Obtenir un reporting hebdomadaire sans effort',
            'before' => [
                'Les chiffres sont répartis dans plusieurs outils',
                'Quelqu’un compile un tableur chaque semaine',
                'Le rapport arrive tard et se périme vite',
            ],
            'after'  => [
                'Les sources sont consolidées automatiquement',
                'Un résumé commenté est envoyé chaque semaine',
                'Une alerte prévient dès qu’un indicateur dérape',
            ],
            'human'  => 'Vous décidez ; l’IA prépare l’information.',
        ],
        [
            'tag'    => 'Service client',
            'title'  => 'Répondre aux questions fréquentes',
            'before' => [
                'Les mêmes questions reviennent chaque jour',
                'Les réponses se cherchent dans des documents épars',
                'Les clients attendent hors horaires d’ouverture',
            ],
            'after'  => [
                'Un assistant répond à partir de vos propres documents',
                'Les réponses citent leur source, pour vérification',
                'Les cas complexes sont transmis à un humain avec le contexte',
            ],
            'human'  => 'Votre équipe se concentre sur les demandes à valeur ajoutée.',
        ],
        [
            'tag'    => 'Opérations',
            'title'  => 'Accueillir un nouveau client ou collaborateur',
            'before' => [
                'Une dizaine de tâches manuelles à chaque arrivée',
                'Des oublis fréquents, selon la charge du moment',
                'Peu de visibilité sur l’avancement',
            ],
            'after'  => [
                'Dossier, accès, emails et tâches créés automatiquement',
                'Des rappels pour ce qui reste à faire',
                'Un suivi clair de chaque onboarding',
            ],
            'human'  => 'Les échanges humains de bienvenue restent personnalisés.',
        ],
    ],

    'faq' => [
        [
            'q' => 'Le devis est-il vraiment gratuit ?',
            'a' => 'Oui. L’appel de 30 minutes et le devis qui suit sont gratuits et sans engagement. Vous repartez avec la liste des tâches automatisables dans votre activité, ce que cela impliquerait et ce que cela coûterait. Vous décidez ensuite librement.',
        ],
        [
            'q' => 'Quelles parties de mon activité peuvent être automatisées avec l’IA ?',
            'a' => 'En général, les tâches répétitives, fréquentes et qui suivent des règles claires : tri d’emails, saisie à partir de documents, relances, reporting, qualification de demandes, réponses aux questions courantes. C’est précisément ce que nous analysons avec vous pendant l’appel, en partant de votre façon de travailler réelle.',
        ],
        [
            'q' => 'Dois-je changer mes outils actuels ?',
            'a' => 'Non. Nous connectons l’IA à ce que vous utilisez déjà : messagerie, CRM, tableurs, logiciels métiers, drive. L’objectif est d’alléger votre quotidien, pas de vous imposer une migration.',
        ],
        [
            'q' => 'L’IA peut-elle faire des erreurs ?',
            'a' => 'Oui, comme tout le monde. C’est pourquoi nous prévoyons des points de validation humaine là où l’enjeu le justifie, des contrôles automatiques et des alertes en cas de doute. Nous vous disons aussi franchement quand une tâche ne se prête pas à l’automatisation.',
        ],
        [
            'q' => 'Mes données sont-elles protégées ?',
            'a' => 'Nous vous aidons à choisir des solutions respectueuses du RGPD, à limiter les données transmises au strict nécessaire et à documenter ce qui est traité et où. Les contraintes de confidentialité propres à votre activité sont abordées dès l’appel.',
        ],
        [
            'q' => 'Combien de temps faut-il pour mettre en place une automatisation ?',
            'a' => 'Cela dépend de la complexité : certaines automatisations simples se déploient rapidement, d’autres demandent plus de préparation. Le devis précise le périmètre, le planning et les étapes, avec une première version utilisable que l’on améliore ensuite.',
        ],
        [
            'q' => 'Faut-il des compétences techniques de mon côté ?',
            'a' => 'Aucune. Vous nous expliquez comment vous travaillez, nous nous occupons du reste, y compris de la prise en main par vos équipes.',
        ],
        [
            'q' => 'Pour quelles entreprises travaillez-vous ?',
            'a' => 'Pour les TPE et PME de tous secteurs, ainsi que les équipes qui souhaitent gagner du temps sur leurs tâches répétitives. Si le sujet vous parle, l’appel permet de le vérifier rapidement.',
        ],
    ],
];
