FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf


RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 80