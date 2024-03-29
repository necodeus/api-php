FROM php:8.3-fpm-alpine

# Dependencies
RUN apk --no-cache --update add linux-headers \
    git \
    autoconf \
    g++ \
    make \
    libpng-dev \
    freetype-dev \
    jpeg-dev \
    libjpeg-turbo-dev \
    libzip-dev \
    icu-dev

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl pdo_mysql zip

RUN docker-php-ext-configure gd \
        --with-freetype=/usr/lib/ \
        --with-jpeg=/usr/lib/
RUN docker-php-ext-install gd

#RUN git clone -b xdebug_3_2 https://github.com/xdebug/xdebug.git /root/xdebug \
#    && cd /root/xdebug \
#    && sh ./rebuild.sh
#RUN echo 'zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20220829/xdebug.so' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.mode = coverage" >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.start_with_request = yes" >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["sh", "-c", "composer install; php-fpm"]
