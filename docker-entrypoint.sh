#!/bin/sh
set -e

echo "Starting XL SATU Sales container..."

# ------------------------------------------------------------------
# 1. Validate APP_KEY — required for Laravel in production.
# ------------------------------------------------------------------
if [ -z "${APP_KEY}" ]; then
    echo "ERROR: APP_KEY is not set." >&2
    echo "Generate one with:  php artisan key:generate --show" >&2
    echo "Then add APP_KEY to your Render environment variables." >&2
    exit 1
fi

# ------------------------------------------------------------------
# 2. Run database migrations (safe on every boot).
# ------------------------------------------------------------------
echo "Running database migrations..."
php artisan migrate --force

# ------------------------------------------------------------------
# 3. Seed on first deploy only (idempotent, controlled by APP_SEED).
#    Admin credentials come from ADMIN_USERNAME / ADMIN_PASSWORD / ...
# ------------------------------------------------------------------
if [ "${APP_SEED:-false}" = "true" ]; then
    echo "Seeding database (APP_SEED=true)..."
    php artisan db:seed --force
fi

# ------------------------------------------------------------------
# 4. Storage link + production caches.
# ------------------------------------------------------------------
echo "Linking storage..."
php artisan storage:link

echo "Building production caches (config/route/view/event)..."
php artisan optimize

# ------------------------------------------------------------------
# 5. Fix permissions for runtime writers.
# ------------------------------------------------------------------
chown -R www-data:www-data storage bootstrap/cache

# ------------------------------------------------------------------
# 6. Render sets PORT dynamically — inject it into the Nginx config.
# ------------------------------------------------------------------
export PORT="${PORT:-8080}"
echo "Listening on port ${PORT}"
envsubst '${PORT}' < /etc/nginx/http.d/default.conf.template > /etc/nginx/http.d/default.conf
rm -f /etc/nginx/http.d/default.conf.template

# ------------------------------------------------------------------
# 7. Start PHP-FPM (background) + Nginx (foreground).
# ------------------------------------------------------------------
php-fpm &
exec nginx -g 'daemon off;'
