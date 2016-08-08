FROM ubuntu:latest

RUN apt-get update
RUN apt-get -y upgrade

RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y nano git htop curl wget build-essential software-properties-common acl

RUN add-apt-repository -y ppa:ondrej/php

RUN apt-get update

RUN apt-get install -y --allow-unauthenticated \
    php7.0-fpm \
    php-apcu \
    php-mcrypt \
    php7.0-curl \
    php7.0-gd \
    php7.0-iconv \
    php-imagick \
    php7.0-json \
    php7.0-intl \
    php7.0-mcrypt \
    php7.0-mysql \
    php7.0-opcache \
    php7.0-pdo \
    php7.0-mysql \
    php7.0-mysqli \
    php7.0-xml

# Scripts
COPY config.sh /config.sh
COPY entrypoint.sh /entrypoint.sh

RUN /config.sh
RUN mkdir -p /run/php/

WORKDIR /var/www

EXPOSE 9000

ENTRYPOINT ["/entrypoint.sh"]

# Start PHP-FPM in foreground mode
CMD /usr/sbin/php-fpm7.0 -F