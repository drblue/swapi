#!/usr/bin/env sh
set -eu

cd /var/www/html

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

if [ "${DB_CONNECTION:-mysql}" = "mysql" ]; then
    echo "Waiting for MySQL at ${DB_HOST:-db}:${DB_PORT:-3306}..."
	attempts=0
	last_error_file="/tmp/swapi-mysql-check-error.log"

    until mysql --protocol=TCP --ssl=0 -h"${DB_HOST:-db}" -P"${DB_PORT:-3306}" -u"${DB_USERNAME:-swapi}" -p"${DB_PASSWORD:-swapi}" -N -B -e "SELECT 1" "${DB_DATABASE:-swapi}" > /dev/null 2> "$last_error_file"; do
		attempts=$((attempts + 1))

		if [ "$attempts" -ge 60 ]; then
			echo "Could not connect to MySQL after $attempts attempts." >&2
			echo "Last MySQL error:" >&2
			cat "$last_error_file" >&2 || true
			echo "Check that DB_USERNAME/DB_PASSWORD in .env.docker match the credentials stored in the existing MySQL Docker volume." >&2
			echo "If this is a disposable local database, remove the volume with: docker compose down -v" >&2
			exit 1
		fi

        sleep 2
    done

    table_count="$(mysql --protocol=TCP --ssl=0 -h"${DB_HOST:-db}" -P"${DB_PORT:-3306}" -u"${DB_USERNAME:-swapi}" -p"${DB_PASSWORD:-swapi}" -N -B -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '${DB_DATABASE:-swapi}'")"

    if [ "${BOOTSTRAP_DATABASE:-true}" = "true" ] && [ "$table_count" = "0" ]; then
		dump_path="${DB_BOOTSTRAP_DUMP:-/var/www/html/database/bootstrap/swapi.sql}"

        if [ -f "$dump_path" ]; then
            echo "Bootstrapping empty database from $dump_path..."
            mysql --protocol=TCP --ssl=0 -h"${DB_HOST:-db}" -P"${DB_PORT:-3306}" -u"${DB_USERNAME:-swapi}" -p"${DB_PASSWORD:-swapi}" "${DB_DATABASE:-swapi}" < "$dump_path"
        else
            echo "Database is empty but bootstrap dump was not found at $dump_path." >&2
            exit 1
        fi
    fi
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
