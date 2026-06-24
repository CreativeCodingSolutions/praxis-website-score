#!/bin/bash
# Entrypoint for PWS container — updates CA certificates on startup
set -e

# Update CA certificates (fixes SSL verification for SMTP, API calls, etc.)
update-ca-certificates 2>/dev/null || true

# Generate app key if missing
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Cache Laravel config/routes/views
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Run migrations
php artisan migrate --force 2>/dev/null || true

# Start PHP built-in server
exec php artisan serve --host=0.0.0.0 --port=10000
