FROM debian:jessie

MAINTAINER Davor Plehati <davor.plehati@trikoder.net>

# Tools
RUN apt-get update && apt-get install -y \
    apt-utils \
    curl \
    git

# PHP
RUN apt-get install -y \
    php5 \
    php5-cli \
    php5-fpm \
    php5-gd \
    php5-mcrypt \
    php5-mysql \
    php5-curl \
    php-pear \
    php5-json \
    php5-intl \
    php5-xdebug

WORKDIR /

# Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

# Scripts
COPY config.sh /config.sh
COPY entrypoint.sh /entrypoint.sh

# Configs
COPY etc/php.d/*.ini /etc/php5/mods-available/

# Configure PHP-FPM
RUN /config.sh

WORKDIR /var/www

EXPOSE 9000

ENTRYPOINT ["/entrypoint.sh"]

# Start PHP-FPM in foreground mode
CMD /usr/sbin/php5-fpm -F