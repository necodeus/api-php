FROM php:8.2-fpm-alpine

# PHP
RUN apk add icu-dev
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-configure intl && docker-php-ext-install intl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Git
RUN apk add git

CMD ["sh", "-c", "composer install; php-fpm"]