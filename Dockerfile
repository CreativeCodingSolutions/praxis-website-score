FROM debian:bookworm-slim

RUN apt-get update && apt-get install -y --no-install-recommends \
    php8.2-cli php8.2-sqlite3 php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip php8.2-bcmath php8.2-fileinfo php8.2-pgsql \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock ./
RUN composer update --no-dev --optimize-autoloader --no-scripts 2>&1

COPY . .

RUN mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/app bootstrap/cache database \
    && chmod -R 775 storage bootstrap/cache \
    && touch database/database.sqlite 2>/dev/null || true

# Generate app key if not set
RUN php artisan key:generate --force 2>/dev/null || true

EXPOSE 10000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
