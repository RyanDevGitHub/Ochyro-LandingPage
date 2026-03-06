FROM nginx:stable
WORKDIR /usr/share/nginx/html

# On copie tout
COPY . .

# IMPORTANT : On change la config pour pointer sur le dossier public
# Crée un fichier default.conf (voir ci-dessous) et ajoute cette ligne :
COPY default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]