FROM php:8.2-cli

WORKDIR /var/www

COPY . .

RUN chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true \
    && chmod -R 775 storage bootstrap/cache 2>/dev/null || true \
    && php artisan key:generate --force 2>/dev/null || true

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080]
