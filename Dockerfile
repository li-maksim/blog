FROM php:8.2-apache AS base

RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libzip-dev libonig-dev curl \
  && docker-php-ext-install pdo_mysql mysqli mbstring zip \
  && a2enmod rewrite \
  && a2dismod mpm_worker \
  && a2enmod mpm_prefork \
  && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock* ./

RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction --no-progress

COPY . /var/www/html

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
 && sed -i 's|<Directory /var/www/html>|<Directory /var/www/html/public>|g' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html \
 && find /var/www/html -type d -exec chmod 755 {} \; \
 && find /var/www/html -type f -exec chmod 644 {} \; \
 && mkdir -p /var/www/html/var/cache /var/www/html/var/log /var/www/html/uploads \
 && chown -R www-data:www-data /var/www/html/var /var/www/html/uploads

EXPOSE 80

CMD ["apache2-foreground"]
