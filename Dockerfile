FROM nginx:stable
WORKDIR /usr/share/nginx/html
COPY . .
# Expose le port 80 (qui sera mappé sur le port 8088 du VPS par le pipeline)
EXPOSE 80

# Commande par défaut pour démarrer Nginx
CMD ["nginx", "-g", "daemon off;"]