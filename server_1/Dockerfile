FROM php:8.0-apache

WORKDIR /var/www/html

# Activer le module Apache mod_rewrite
RUN a2enmod rewrite
# COPY docker-virtualhost.ini /usr/local/etc/php/conf.d/docker-virtualhost.ini
COPY www/ .
RUN service apache2 restart
# pour permettre la configuration
RUN chmod 777 /var/www/html/src/controllers/

EXPOSE 80