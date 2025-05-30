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

# Copia el código del proyecto Laravel
COPY . /var/www/html

# Establece permisos correctos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Instala dependencias de Laravel
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Habilita Apache mod_rewrite
RUN a2enmod rewrite

# Configura Apache para Laravel
COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf
