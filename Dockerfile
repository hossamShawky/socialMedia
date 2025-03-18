FROM php:8.1-fpm-alpine as build

WORKDIR /app

COPY . /app

RUN apk update \
    && apk add openssl curl zip unzip git libzip-dev libpng-dev oniguruma-dev libxml2-dev \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-install pdo pdo_mysql gd zip exif pcntl mbstring xml bcmath \
    && docker-php-ext-enable pdo_mysql bcmath 

RUN       chmod -R 777 storage/framework/
RUN composer update
# --optimize-autoloader --no-interaction --prefer-dist   


RUN chmod -R 777 /app/storage/logs

EXPOSE 8000

CMD rm /app/public/storage; php artisan storage:link; chmod -R 777 /app/storage/logs ; php artisan serve --host=0.0.0.0 --port=8000

