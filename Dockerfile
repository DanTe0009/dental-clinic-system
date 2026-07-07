FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

ENV WEBROOT=/var/www/html/public
ENV SKIP_COMPOSER=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1

RUN composer install --no-dev --optimize-autoloader
RUN php artisan config:clear
RUN php artisan route:clear
RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD ["/start.sh"]