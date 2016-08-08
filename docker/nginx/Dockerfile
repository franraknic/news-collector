FROM nginx:latest

COPY etc/default.conf /etc/nginx/conf.d/default.template
COPY config.sh /config.sh

WORKDIR /var/www

EXPOSE 80

CMD /bin/bash -c "/config.sh > /etc/nginx/conf.d/default.conf && nginx -g 'daemon off;'"
