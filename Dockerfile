FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

ENV WEBROOT=/var/www/html/public
ENV SKIP_COMPOSER=1
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN composer install --no-dev --optimize-autoloader
RUN chmod -R 775 storage bootstrap/cache