FROM debian:bookworm-slim

RUN apt-get update && apt-get install -y --no-install-recommends \
    php8.4-cli php8.4-sqlite3 php8.4-mbstring php8.4-xml php8.4-curl php8.4-zip php8.4-bcmath php8.4-fileinfo \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www

COPY . .

RUN mkdir -p storage/framework/views storage/framework/cache storage/app bootstrap/cache database \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && php artisan key:generate --force || true

EXPOSE 10000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
