FROM php:8.2-apache

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el proyecto al contenedor
COPY . /var/www/html

# Habilita Apache mod_rewrite
RUN a2enmod rewrite

# Configura Apache para Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf
