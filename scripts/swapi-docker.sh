#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT_DIR"

COMPOSE=(docker compose)

if ! docker compose version >/dev/null 2>&1; then
    if command -v docker-compose >/dev/null 2>&1; then
        COMPOSE=(docker-compose)
    else
        echo "Docker Compose is missing. Install Docker Compose v2 or docker-compose." >&2
        exit 1
    fi
fi

random_base64() {
    openssl rand -base64 32 | tr -d '\n'
}

ensure_env() {
    if [ -f .env.docker ]; then
        return
    fi

    if ! command -v openssl >/dev/null 2>&1; then
        echo "openssl is missing and is required to create .env.docker automatically." >&2
        exit 1
    fi

    app_key="base64:$(random_base64)"
    db_password="$(random_base64)"
    root_password="$(random_base64)"

    cat > .env.docker <<EOF
COMPOSE_PROJECT_NAME=swapi

APP_NAME="StarWars API"
APP_ENV=production
APP_KEY=${app_key}
APP_DEBUG=false
APP_URL=http://localhost:8080
APP_BIND=127.0.0.1
APP_PORT=8080
SWAPI_IMAGE=ghcr.io/drblue/swapi:latest

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=warning

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=swapi
DB_USERNAME=swapi
DB_PASSWORD=${db_password}

MYSQL_DATABASE=swapi
MYSQL_USER=swapi
MYSQL_PASSWORD=${db_password}
MYSQL_ROOT_PASSWORD=${root_password}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

RUN_MIGRATIONS=true
RUN_EXTENSION_IMPORT=true
BOOTSTRAP_DATABASE=true
DB_BOOTSTRAP_DUMP=/var/www/html/database/bootstrap/swapi.sql
CACHE_CONFIG=true
EOF

    chmod 600 .env.docker
    echo "Created .env.docker. Adjust APP_URL and APP_PORT before public deployment if needed."
}

load_env() {
    ensure_env
    set -a
    # shellcheck disable=SC1091
    source .env.docker
    set +a
}

start() {
    load_env
    "${COMPOSE[@]}" up -d --build
}

stop() {
    load_env
    "${COMPOSE[@]}" stop
}

restart() {
    load_env
    "${COMPOSE[@]}" restart
}

update() {
    load_env
    git pull --ff-only
    "${COMPOSE[@]}" build --pull app
    "${COMPOSE[@]}" up -d
}

status() {
    load_env
    "${COMPOSE[@]}" ps
}

logs() {
    load_env
    "${COMPOSE[@]}" logs -f --tail=200 "${2:-}"
}

case "${1:-}" in
    start) start ;;
    stop) stop ;;
    restart) restart ;;
    update) update ;;
    status) status ;;
    logs) logs "$@" ;;
    *)
        cat <<'EOF'
Usage: scripts/swapi-docker.sh <command>

Commands:
  start    Create .env.docker if needed, build, and start the app
  stop     Stop containers without removing database volumes
  restart  Restart containers
  update   Run git pull --ff-only, rebuild the app, and start the updated version
  status   Show container status
  logs     Follow container logs, optionally: logs app or logs db

The database is stored in the swapi_mysql Docker volume and survives stop/start/update.
EOF
        exit 1
        ;;
esac
