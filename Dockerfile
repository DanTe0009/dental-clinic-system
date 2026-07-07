FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

ENV WEBROOT /var/www/html/public

CMD sed -i "s/listen 80;/listen ${PORT};/" /etc/nginx/conf.d/default.conf && supervisord -n

EXPOSE 10000