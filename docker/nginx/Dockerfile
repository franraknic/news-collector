FROM nginx:latest

COPY etc/default.conf etc/nginx/conf.d/default.conf

WORKDIR /var/www

EXPOSE 80

CMD /bin/bash -c "nginx -g 'daemon off;'"
