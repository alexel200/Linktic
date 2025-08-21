FROM php:8.4-apache
LABEL authors="jhonrueda"

RUN apt-get update && apt-get install -y \
    # PHP extension development libraries
    libpng-dev \
    libxml2-dev \
    libonig-dev \
    libzip-dev \
    # MySQL client libraries
    libmariadb-dev-compat \
    # General utilities
    zip \
    unzip \
    curl \
    git \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl zip \
    && docker-php-ext-enable zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install

COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

