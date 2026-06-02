FROM composer:2.7 AS composer

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# ---

FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    nginx \
    supervisor \
    sqlite \
    libpng \
    libjpeg-turbo \
    freetype \
    libzip \
    && docker-php-ext-install pdo pdo_sqlite gd zip opcache \
    && apk del --no-cache

WORKDIR /var/www

COPY --from=composer /app/vendor ./vendor
COPY . .

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && php artisan optimize

# Generate APP_KEY if not set
RUN php artisan key:generate --force || true

COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf

EXPOSE 8080

CMD ["supervisord", "-c", "/etc/supervisord.conf"]
