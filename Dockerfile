# COMPOSER INTERMEDIATE CONTAINER
#
#
FROM composer:1.5.1 AS composer


# PHP CONTAINER
#
#

FROM php:7.2.18-fpm-alpine

# PHP
#ADD ./logging.ini /usr/local/etc/php/conf.d
#ADD ./lumen.ini /usr/local/etc/php/conf.d

# PHP-FPM
#ADD ./lumen.pool.conf /usr/local/etc/php-fpm.d
#RUN rm /usr/local/etc/php-fpm.d/www.conf*

# Environment variables
ENV ALPINE_VERSION 3.4
ENV IMAGICK_VERSION=3.4.3
# ENV AMQP_VERSION=1.8.0
ENV LOG_STREAM="/tmp/stdout"

# Install & clean up dependencies
RUN apk --no-cache --update --repository http://dl-cdn.alpinelinux.org/alpine/v$ALPINE_VERSION/main/ add \
    autoconf \
    build-base \
    ca-certificates \
&& apk --no-cache --update --repository http://dl-3.alpinelinux.org/alpine/v3.5/main/ add \
    curl \
    openssl \
    openssl-dev \
    libtool \
    icu \
    icu-libs \
    icu-dev \
    libwebp \
    libpng \
    libpng-dev \
    libjpeg-turbo \
    libjpeg-turbo-dev \
    imagemagick-dev \
    imagemagick \
&& apk --no-cache --update --repository http://dl-3.alpinelinux.org/alpine/v3.5/community/ add \
    php7-gd \
    php7-sockets \
    php7-zlib \
    php7-intl \
    php7-opcache \
    php7-bcmath \
&& docker-php-ext-configure intl \
&& docker-php-ext-configure gd \
    --with-png-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ \
&& pecl install \
    imagick-$IMAGICK_VERSION \
    # amqp-$AMQP_VERSION \
&& docker-php-ext-install \
    pdo_mysql \
    sockets \
    gd \
    intl \
    opcache \
    bcmath \
&& docker-php-ext-enable \
    imagick \
    # amqp \
&& apk --no-cache del \
    wget \
    icu-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    imagemagick-dev \
    tar \
    autoconf \
    build-base \
    libtool \
&& rm -rf /var/cache/apk/* /tmp/*

RUN mkfifo $LOG_STREAM && chmod 777 $LOG_STREAM

CMD sh -c "php-fpm -D | tail -f $LOG_STREAM"

EXPOSE 8000

WORKDIR /var/www/application

COPY api .

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN composer install

RUN cd public

RUN nohup php -S 0.0.0.0:8000 &

# ANGULAR CONTAINER
#
#

FROM node:10.15.3-stretch

EXPOSE 3000

WORKDIR /var/www/application

COPY frontend .

RUN npm i -g @angular/cli

RUN npm install

RUN ng serve --prod --port 3000
