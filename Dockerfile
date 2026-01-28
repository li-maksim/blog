FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install pdo_mysql mysqli mbstring zip exif pcntl \
    && a2enmod rewrite  # Enable Apache mod_rewrite for clean URLs

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

COPY src/ .

COPY composer.json composer.lock* ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p var/cache var/log uploads && \
    chown -R www-data:www-data var uploads

EXPOSE 80