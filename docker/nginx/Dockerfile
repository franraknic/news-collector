FROM nginx:latest

# Add user
RUN adduser --disabled-password --gecos "" symfony

COPY etc/default.conf /etc/nginx/conf.d/default.template
COPY config.sh /config.sh
RUN sed -i 's/user www-data/user symfony/g' /etc/nginx/nginx.conf



WORKDIR /var/www

EXPOSE 80

CMD /bin/bash -c "/config.sh > /etc/nginx/conf.d/default.conf && nginx -g 'daemon off;'"
