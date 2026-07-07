FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html/public

COPY . .

RUN rm -f /etc/nginx/conf.d/default.conf

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:clear

RUN chmod -R 777 storage bootstrap/cache