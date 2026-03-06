# On utilise une image qui contient à la fois Nginx et PHP 8.2
FROM webdevops/php-nginx:8.2-alpine

# On définit le dossier où sera ton code
WORKDIR /app

# On dit à cette image que la racine du site est le dossier 'public'
# Cela remplace le besoin de modifier manuellement le default.conf
ENV WEB_DOCUMENT_ROOT=/app/public

# On copie tout ton projet dans le dossier /app
COPY . .

# On s'assure que les permissions sont bonnes pour le serveur web
RUN chown -R application:application /app

EXPOSE 80