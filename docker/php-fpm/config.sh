#!/usr/bin/env bash

sed -i "s/;date.timezone =.*/date.timezone = Europe\/Zagreb/" /etc/php/7.0/fpm/php.ini
sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.0/fpm/php-fpm.conf
sed -i -e "s/error_log\s*=.*/error_log = \/proc\/self\/fd\/2/g" /etc/php/7.0/fpm//php-fpm.conf
sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php/7.0/fpm/php.ini
sed -i '/^listen/clisten = [::]:9000' /etc/php/7.0/fpm/pool.d/www.conf
sed -i '/^listen.allowed_clients/c;listen.allowed_clients =' /etc/php/7.0/fpm/pool.d/www.conf
sed -i '/^;catch_workers_output/ccatch_workers_output = yes' /etc/php/7.0/fpm/pool.d/www.conf
sed -i -e 's/php_admin_value\[error_log\]\s*=.*/php_admin_value\[error_log\] = \/proc\/self\/fd\/2/g' /etc/php/7.0/fpm/pool.d/www.conf
