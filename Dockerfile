FROM php:8.2-cli

RUN apt-get update && apt-get install -y nginx supervisor sqlite3 \
    && docker-php-ext-install pdo pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www

# Copy everything (vendor included)
COPY . .

# Set permissions
RUN mkdir -p storage/framework/views storage/framework/cache storage/app bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copy nginx and supervisor configs
COPY docker/nginx.conf /etc/nginx/sites-available/default 2>/dev/null || true
COPY docker/supervisord.conf /etc/supervisord.conf 2>/dev/null || true

# Generate key
RUN php artisan key:generate --force || true

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080
