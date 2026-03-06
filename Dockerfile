FROM nginx:stable
WORKDIR /usr/share/nginx/html

# 1. Copie d'abord ton code (comme avant)
COPY . .

# 2. Écrase la configuration par défaut de Nginx par la tienne
COPY default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]