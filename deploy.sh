#!/bin/bash
# Deploy script for Praxis Website Score on VPS

set -e

PROJECT="praxiswebsitescore"
GITHUB_URL="https://github.com/CreativeCodingSolutions/praxis-website-score.git"
APP_DIR="/home/deployer/www/${PROJECT}"
DYNAMIC_FILE="/docker/traefik/dynamic/dynamic.yml"
APP_PORT="10000"

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
docker compose exec -T app php artisan key:generate --force 2>/dev/null || true
docker compose exec -T app php artisan config:cache 2>/dev/null || true
docker compose exec -T app php artisan route:cache 2>/dev/null || true
docker compose exec -T app php artisan view:cache 2>/dev/null || true
docker compose exec -T app php artisan migrate --force 2>/dev/null || true

# 5. Permissions
docker compose exec -T app chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# 6. Update Traefik dynamic config
echo "→ Updating Traefik config..."
if grep -q "${PROJECT}.creativecoding.cloud" "$DYNAMIC_FILE" 2>/dev/null; then
    echo "→ Already in Traefik"
else
    python3 << PYEOF
import yaml
with open("${DYNAMIC_FILE}", "r") as f:
    config = yaml.safe_load(f)
config["http"]["services"]["${PROJECT}"] = {"loadBalancer": {"servers": [{"url": "http://localhost:${APP_PORT}"}]}}
config["http"]["routers"]["${PROJECT}"] = {
    "rule": "Host(`${PROJECT}.creativecoding.cloud`)",
    "entryPoints": ["websecure"],
    "service": "${PROJECT}",
    "tls": {"certResolver": "letsencrypt"}
}
with open("${DYNAMIC_FILE}", "w") as f:
    yaml.dump(config, f, default_flow_style=False, allow_unicode=True)
PYEOF
    docker restart traefik 2>&1 || true
fi

echo "=== ${PROJECT} deployed! ==="
echo "→ https://${PROJECT}.creativecoding.cloud"
