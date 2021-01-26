FROM  php:7.4-fpm-alpine

#RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/main" >> /etc/apk/repositories \
#&& echo "http://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories \
#&& echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories \

RUN apk update && apk upgrade \
&& apk add --no-cache \
    autoconf \
    g++ \
    libtool \
    make \
    libxml2-dev \
    libpng-dev \
    imap-dev \
    postgresql-dev \
    libzip-dev \
&& docker-php-ext-install \
    soap \
    bcmath \
    gd \
    imap \
    pcntl \
    mysqli \
    pdo_pgsql \
    pdo_mysql \
    zip \
&& pecl install xdebug \
&& docker-php-ext-enable xdebug \
&& pecl install redis \
&& docker-php-ext-enable redis \
&& apk del \
    gcc \
    musl-dev \
    php7-pear \
    php7-dev \
    autoconf \
    libtool \
    automake \
    g++ \
    make \
    byacc \
    flex \
    git \
&& set -eux; addgroup -g 1000 -S local; adduser --u 1000 -D -S -G local local; sed -i s/www-data/local/g /usr/local/etc/php-fpm.d/www.conf \
&& apk add py-pip \
&& apk add supervisor \
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
&& apk add --update nodejs nodejs-npm

ADD conf/laravel-queue.ini conf/php-fpm.ini /etc/supervisor.d/

WORKDIR /var/www/back

CMD ["supervisord", "-n"]
