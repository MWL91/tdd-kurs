FROM php:8.3-apache

RUN pecl install xdebug \
    && docker-php-ext-install bcmath \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /app