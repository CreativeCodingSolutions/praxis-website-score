#!/bin/bash
# Deploy script for CreativeCoding Solutions apps
# Deploy Praxis Website Score with new lead-generating features

set -e

PROJECT="praxiswebsitescore"
GITHUB_URL="https://github.com/CreativeCodingSolutions/praxis-website-score.git"
APP_DIR="/var/www/${PROJECT}"
DYNAMIC_FILE="/docker/traefik/dynamic/dynamic.yml"

echo "=== Deploying ${PROJECT} ==="

# 1. Clone or pull
if [ -d "$APP_DIR/.git" ]; then
    echo "→ Pulling latest..."
    cd "$APP_DIR"
    git pull origin main 2>&1 || git pull origin master 2>&1
else
    echo "→ Cloning..."
    git clone "$GITHUB_URL" "$APP_DIR" 2>&1
    cd "$APP_DIR"
fi

# 2. Build and start with Docker Compose
echo "→ Building Docker container..."
docker compose down 2>/dev/null || true
docker compose build --no-cache
docker compose up -d

# 3. Wait for container to be ready
echo "→ Waiting for container..."
sleep 5

# 4. Run Laravel setup
echo "→ Laravel setup..."
docker compose exec -T ${PROJECT} php artisan key:generate --force 2>/dev/null || true
docker compose exec -T ${PROJECT} php artisan config:cache 2>/dev/null || true
docker compose exec -T ${PROJECT} php artisan route:cache 2>/dev/null || true
docker compose exec -T ${PROJECT} php artisan view:cache 2>/dev/null || true
docker compose exec -T ${PROJECT} php artisan migrate --force 2>/dev/null || true

# 5. Permissions
docker compose exec -T ${PROJECT} chmod -R 775 storage bootstrap/cache 2>/dev/null || true

echo "=== ${PROJECT} deployed! ==="
echo "→ https://${PROJECT}.creativecoding.cloud"
