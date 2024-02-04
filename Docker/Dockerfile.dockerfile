FROM php:8.3-fpm-alpine

RUN apk update && apk add --no-cache nano \
    git \
    unzip \
    postgresql-dev \
    libzip-dev \
    nodejs npm \
    && docker-php-ext-install pdo_mysql pdo_pgsql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
