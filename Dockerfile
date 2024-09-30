FROM php:8.1-apache

# Dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libcurl4-openssl-dev pkg-config libssl-dev \
    libzip-dev unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Compose
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

WORKDIR /var/www/html
