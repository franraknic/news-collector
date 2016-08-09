#!/usr/bin/env bash

for filename in "/etc/php5/fpm/php.ini" "/etc/php5/cli/php.ini"
do
    sed -i "s/;date.timezone =.*/date.timezone = Europe\/Zagreb/" $filename
    sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" $filename
done

sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php5/fpm/php-fpm.conf
sed -i -e "s/error_log\s*=.*/error_log = \/proc\/self\/fd\/2/g" /etc/php5/fpm/php-fpm.conf
sed -i '/^listen/clisten = [::]:9000' /etc/php5/fpm/pool.d/www.conf
sed -i '/^listen.allowed_clients/c;listen.allowed_clients =' /etc/php5/fpm/pool.d/www.conf
sed -i '/^;catch_workers_output/ccatch_workers_output = yes' /etc/php5/fpm/pool.d/www.conf
sed -i -e 's/php_admin_value\[error_log\]\s*=.*/php_admin_value\[error_log\] = \/proc\/self\/fd\/2/g' /etc/php5/fpm/pool.d/www.conf
sed -i 's/user = www-data/user = symfony/g' /etc/php5/fpm/pool.d/www.conf
sed -i 's/group = www-data/group = symfony/g' /etc/php5/fpm/pool.d/www.conf