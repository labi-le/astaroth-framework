FROM php:8.1-cli-alpine

RUN apk update && apk add \
    build-base

RUN apk add libzip-dev curl-dev libxml2-dev postgresql-dev
RUN apk add --update composer
RUN docker-php-ext-install curl xml zip sockets pdo_pgsql pcntl

WORKDIR /app/

#RUN composer install --no-dev --classmap-authoritative

#ENTRYPOINT ["php", "index.php"]