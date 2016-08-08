#!/usr/bin/env bash

sed "s/<NGINX_HOST>/${NGINX_HOST}/" /etc/nginx/conf.d/default.template | \
sed "s/<PHP_INDEX>/${PHP_INDEX}/"
