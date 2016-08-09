FROM debian:jessie

MAINTAINER Davor Plehati <davor.plehati@trikoder.net>

RUN groupadd symfony --gid=1000 && useradd -g symfony --uid=1000 symfony

# gosu
ENV GOSU_VERSION 1.9
RUN set -x \
    && apt-get update && apt-get install -y --no-install-recommends ca-certificates wget && rm -rf /var/lib/apt/lists/* \
    && dpkgArch="$(dpkg --print-architecture | awk -F- '{ print $NF }')" \
    && wget -O /usr/local/bin/gosu "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-$dpkgArch" \
    && wget -O /usr/local/bin/gosu.asc "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-$dpkgArch.asc" \
    && export GNUPGHOME="$(mktemp -d)" \
    && gpg --keyserver ha.pool.sks-keyservers.net --recv-keys B42F6819007F00F88E364FD4036A9C25BF357DD4 \
    && gpg --batch --verify /usr/local/bin/gosu.asc /usr/local/bin/gosu \
    && rm -r "$GNUPGHOME" /usr/local/bin/gosu.asc \
    && chmod +x /usr/local/bin/gosu \
    && gosu nobody true \
    && apt-get purge -y --auto-remove ca-certificates wget

# Tools
RUN apt-get update && apt-get install -y \
    apt-utils \
    curl \
    git \
    acl

# PHP
RUN apt-get update && apt-get install -y \
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

CMD ["php-fpm"]