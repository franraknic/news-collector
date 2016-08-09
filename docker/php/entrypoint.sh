#!/usr/bin/env bash

set -e

case "$1" in
    php-fpm)
        # Start PHP-FPM in foreground mode
        exec /usr/sbin/php5-fpm -F
        ;;
    *)
        exec "$@";;
esac