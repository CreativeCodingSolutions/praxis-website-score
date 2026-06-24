# PWS Lead-Capture v2 — Fix: ip_address column missing

## Root Cause

The migration `2026_06_24_000002_add_ip_address_to_leads_table` was never executed on the VPS.
The `ip_address` column was partially added by `2026_06_24_000000_ensure_leads_table_pws_landing` (which has a `Schema::hasColumn` guard), but the dedicated migration that ALTERs the table was never recorded in the `migrations` table. The app's `POST /check` endpoint queries the `ip_address` column and throws a 500 when the migration state is inconsistent.

## Fix — Commands for Karsten on VPS

Run these in sequence:

```bash
# 1. Navigate to the app directory
cd /opt/data/apps/praxis-website-score

# 2. Pull latest code (ensure the migration file exists)
git pull origin main

# 3. Run the pending migrations
docker compose exec -T app php artisan migrate --force

# 4. Verify the migration ran (should show the new row)
docker compose exec -T app php artisan db:select "SELECT * FROM migrations WHERE migration LIKE '%ip_address%';"

# 5. Clear caches to be safe
docker compose exec -T app php artisan config:clear
docker compose exec -T app php artisan cache:clear
```

## Alternative if docker compose exec -T fails (older Docker)

```bash
# Find the container name
docker ps | grep praxis

# Run with container name
docker exec <container_name> php artisan migrate --force
```

## Verification

After running, test:
```bash
curl -X POST https://praxiswebsitescore.creativecoding.cloud/check \
  -H "Content-Type: application/json" \
  -d '{"url":"https://example.com"}'
```

Expected: `200 OK` with score data (not 500 error).

## Migration File

File: `database/migrations/2026_06_24_000002_add_ip_address_to_leads_table.php`
- Adds `ip_address` VARCHAR(45) NULLABLE after `name` in `leads` table
- Idempotent: guarded by `Schema::hasColumn`
