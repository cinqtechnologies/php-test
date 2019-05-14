# MYSQL CONTAINER
#
#
FROM mysql:5.7.26
EXPOSE 3306

# COMPOSER INTERMEDIATE CONTAINER
#
#
FROM composer:1.5.1 AS composer


# PHP CONTAINER
#
#

FROM php:7.2.18-fpm-alpine

# Environment variables
ENV ALPINE_VERSION 3.4
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
&& apk --no-cache --update --repository http://dl-3.alpinelinux.org/alpine/v3.5/community/ add \
    php7-gd \
    php7-zlib \
    php7-intl \
    php7-bcmath \
&& docker-php-ext-configure intl \
&& docker-php-ext-configure gd \
    --with-png-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ \
&& docker-php-ext-install \
    pdo_mysql \
    gd \
    intl \
    bcmath \
&& apk --no-cache del \
    wget \
    icu-dev \
    libpng-dev \
    libjpeg-turbo-dev \
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

RUN php artisan migrate

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

RUN nohup ng serve --prod --port 3000 &
