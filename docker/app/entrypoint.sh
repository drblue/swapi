#!/usr/bin/env sh
set -eu

cd /var/www/html

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

if [ "${DB_CONNECTION:-mysql}" = "mysql" ]; then
    echo "Waiting for MySQL at ${DB_HOST:-db}:${DB_PORT:-3306}..."
    until mysqladmin ping -h"${DB_HOST:-db}" -P"${DB_PORT:-3306}" -u"${DB_USERNAME:-swapi}" -p"${DB_PASSWORD:-swapi}" --silent; do
        sleep 2
    done
fi

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    php artisan migrate --force
fi

if [ "${RUN_EXTENSION_IMPORT:-true}" = "true" ]; then
    php artisan swapi:import-extensions
fi

if [ "${CACHE_CONFIG:-true}" = "true" ]; then
    php artisan config:cache
    php artisan route:cache || true
    php artisan view:cache
fi

exec "$@"
