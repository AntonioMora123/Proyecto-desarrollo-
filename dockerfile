FROM php:8.2-apache

# Instalar extensión mysqli para conectar MySQL
RUN docker-php-ext-install mysqli

# Activar mod_rewrite por si después lo ocupas
RUN a2enmod rewrite

# Copiar proyecto al servidor Apache
COPY . /var/www/html/

# Permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80