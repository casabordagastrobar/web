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

# Copia el proyecto
COPY . /var/www/html
WORKDIR /var/www/html

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Crear carpetas necesarias y dar permisos
RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Habilita mod_rewrite de Apache
RUN a2enmod rewrite

# Configura Apache para apuntar a public/
COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf
