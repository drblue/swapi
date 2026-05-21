# StarWars API

Laravel-clone of swapi.dev, but with improved relationships.

A deployment of this API is available at [https://swapi.thehiveresistance.com](https://swapi.thehiveresistance.com).

## Installation

1. Clone the repo and `cd` into it

2. Install composer dependencies

    ```bash
    composer install
    ```

3. Install npm dependencies

    ```bash
    npm install
    ```

4. Create a copy of your .env file

    ```bash
    cp .env.example .env
    ```

5. Generate an app encryption key

    ```bash
    php artisan key:generate
    ```

6. Create an empty database for our application

7. In the .env file, add database information to allow Laravel to connect to the database

8. Import the bootstrap database dump from `database/bootstrap/swapi.sql`

9. Validate the database connection by running

    ```bash
    php artisan migrate
    ```

10. Import extended metadata and selected resource images

    ```bash
    php artisan swapi:import-extensions --optimize
    ```

    The importer reads the bundled extension data in `data/`, normalizes it against the canonical API records, preserves existing dump-provided `image_url` values, copies fallback bundled images into `public/images/{resource}/` only where a resource has no image, stores local fallback URLs as root-relative `/images/...` paths, and optionally runs ImageOptim on the final asset tree. ImageAlpha and JPEGmini can be enabled with `--imagealpha` and `--jpegmini` if those apps are installed locally.

    To preview the import without writing database or image files, run:

    ```bash
    php artisan swapi:import-extensions --dry-run
    ```

11. Start the local development server

    ```bash
    php artisan serve
    ```

12. Visit [http://localhost:8000/api/](http://localhost:8000/api/) in your browser

## Docker Deployment

The app can be deployed with Docker Compose on a VPS. MySQL data is stored in the named Docker volume `swapi_mysql`, so it survives container restarts, app rebuilds, and host reboots. Containers use `restart: unless-stopped`, so Docker starts them again automatically after the VPS reboots.

The bundled SQL dump at `database/bootstrap/swapi.sql` contains the current schema and data used to bootstrap fresh Docker databases. On startup, the app imports it only when the configured MySQL database has no tables, then runs Laravel migrations and `swapi:import-extensions` so future code changes are still applied.

1. Clone the repository on the server and enter the project directory.

2. Start the stack:

    ```bash
    ./scripts/start.sh
    ```

    On first run, the script creates `.env.docker` with a generated `APP_KEY`, database password, and root password. Edit `.env.docker` and set `APP_URL` to the public URL for the VPS before public use.

3. Visit the app on the configured port. The default is `http://localhost:8080/api/`.

Useful commands:

```bash
./scripts/start.sh      # build and start
./scripts/stop.sh       # stop containers, keep volumes
./scripts/restart.sh    # restart containers
./scripts/update.sh     # git pull --ff-only, rebuild app image, restart
./scripts/swapi-docker.sh status
./scripts/swapi-docker.sh logs app
./scripts/swapi-docker.sh logs db
```

The update script does not remove Docker volumes. Do not run `docker compose down -v` unless you intentionally want to delete the database.

### Publish a New Docker Image

Docker images are published automatically by GitHub Actions. Every push to `main` runs `.github/workflows/publish-image.yml`, builds the Docker image, and publishes it to GHCR with two tags:

- `ghcr.io/drblue/swapi:latest`
- `ghcr.io/drblue/swapi:<commit-sha>`

Normal release flow:

1. Merge the tested changes into `main`.

2. Push `main` to GitHub:

    ```bash
    git push origin main
    ```

3. Wait for the `Publish Docker Image` GitHub Actions workflow to pass.

4. Update the VPS deployment:

    ```bash
    docker compose -f docker-compose.ghcr.yml pull
    docker compose -f docker-compose.ghcr.yml up -d
    ```

To publish manually instead, log in to GHCR with a GitHub token that has package write access, then build and push the image:

```bash
echo "$GITHUB_TOKEN" | docker login ghcr.io -u USERNAME --password-stdin
docker build -t ghcr.io/drblue/swapi:latest -t ghcr.io/drblue/swapi:$(git rev-parse HEAD) .
docker push ghcr.io/drblue/swapi:latest
docker push ghcr.io/drblue/swapi:$(git rev-parse HEAD)
```

### Run From GHCR

You do not need to clone the full source tree on the VPS if you want to run the published image from GHCR. Create a deployment directory with only `docker-compose.ghcr.yml` and `.env.docker`.

1. Create `.env.docker`:

    ```env
    COMPOSE_PROJECT_NAME=swapi

    APP_NAME="StarWars API"
    APP_ENV=production
    APP_KEY=base64:CHANGE_ME
    APP_DEBUG=false
    APP_URL=https://swapi.example.com
    APP_BIND=127.0.0.1
    APP_PORT=8080
    SWAPI_IMAGE=ghcr.io/drblue/swapi:latest

    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=swapi
    DB_USERNAME=swapi
    DB_PASSWORD=CHANGE_ME

    MYSQL_DATABASE=swapi
    MYSQL_USER=swapi
    MYSQL_PASSWORD=CHANGE_ME
    MYSQL_ROOT_PASSWORD=CHANGE_ME

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
    ```

    Generate real secrets for `APP_KEY`, `DB_PASSWORD`, and `MYSQL_ROOT_PASSWORD`. `APP_BIND=127.0.0.1` keeps the app private to the VPS so Nginx can proxy to it.

2. Start or update the stack:

    ```bash
    docker compose -f docker-compose.ghcr.yml pull
    docker compose -f docker-compose.ghcr.yml up -d
    ```

    On the first run, the app bootstraps an empty database from the current SQL dump bundled in the image, then runs migrations and the metadata importer.

3. Use Nginx as a reverse proxy:

    ```nginx
    server {
        listen 80;
        server_name swapi.example.com;

        location / {
            proxy_pass http://127.0.0.1:8080;
            proxy_set_header Host $host;
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header X-Forwarded-Proto $scheme;
        }
    }
    ```

To use a specific image version, set `SWAPI_IMAGE` to a commit tag instead of `latest`, for example `ghcr.io/drblue/swapi:<commit-sha>`.

## Usage

Endpoints are available at `/api/` and are documented below.

All index resources return only relationship counts. To get the full relationship (`id` and `name`/`title`), you must use the `GET /api/{resource}/{id}` endpoint.

Index resources include lightweight extended metadata such as `image_url` and `short_description` when available. Detail endpoints additionally include `long_description`.

### Extended Metadata

The API includes curated metadata to build richer interfaces without having to maintain custom extension files.

Common extended fields:

- `image_url` - public URL for the selected resource image
- `short_description` - short summary suitable for cards and list views
- `long_description` - longer text available on detail endpoints

People may also include:

- `force_alignment` - light/dark/neutral alignment when known
- `lightsaber_color` - lightsaber color when known
- `wiki_link` - external wiki link when populated
- `affiliations` - affiliation list when populated

The importer preserves remote image URLs from the canonical dump. When the dump has no image for a resource, it chooses the highest-resolution fallback image from the bundled source datasets and stores it as a root-relative `/images/...` path. API responses prefix those local paths with `APP_URL` at request time. A small explicit override map is supported inside `App\Console\Commands\ImportExtendedMetadata` for obvious outliers.

### Endpoints

By default, the API will return 10 results per page. You can specify a custom page size using the `per_page` query parameter. You can also specify which page to return using the `page` query parameter.

All endpoints support searching by name/title. You can search by using the `search` query parameter.

#### Query Parameters

All query parameters are optional.

- `search` - search for a specific resource
- `page` - the page number to return
- `per_page` - the number of results to return per page (default `10`)

#### People

- `GET /api/characters` - returns all people
- `GET /api/characters/{id}` - returns a person by id

#### Films

- `GET /api/films` - returns all films
- `GET /api/films/{id}` - returns a film by id

#### Starships

- `GET /api/starships` - returns all starships
- `GET /api/starships/{id}` - returns a starship by id

#### Vehicles

- `GET /api/vehicles` - returns all vehicles
- `GET /api/vehicles/{id}` - returns a vehicle by id

#### Species

- `GET /api/species` - returns all species
- `GET /api/species/{id}` - returns a species by id

#### Planets

- `GET /api/planets` - returns all planets
- `GET /api/planets/{id}` - returns a planet by id

## Examples

See the [examples/v2](examples/v2) directory for more example responses.

### `GET /api/characters`

```jsonc
{
    "current_page": 1,
    "data": [
        {
            "birth_year": "19BBY",
            "created": "2014-12-09T13:50:51.644000Z",
            "edited": "2014-12-20T21:17:56.891000Z",
            "eye_color": "blue",
            "films_count": 4,
            "hair_color": "blond",
            "height": "172",
            "homeworld": {
                "id": 1,
                "name": "Tatooine"
            },
            "id": 1,
            "mass": "77",
            "name": "Luke Skywalker",
            "skin_color": "fair",
            "species_count": 0,
            "starships_count": 2,
            "vehicles_count": 2
        }
        // ...
    ],
    "first_page_url": "http://localhost:8000/api/people?page=1",
    "from": 1,
    "last_page": 9,
    "last_page_url": "http://localhost:8000/api/people?page=9",
    "links": [
        {
            "active": false,
            "label": "&laquo; Previous",
            "url": null
        },
        {
            "active": true,
            "label": "1",
            "url": "http://localhost:8000/api/people?page=1"
        },
        // ...
        {
            "active": false,
            "label": "Next &raquo;",
            "url": "http://localhost:8000/api/people?page=2"
        }
    ],
    "next_page_url": "http://localhost:8000/api/people?page=2",
    "path": "http://localhost:8000/api/people",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 82
}
```

### `GET /api/characters/1`

```jsonc
{
    "birth_year": "19BBY",
    "created": "2014-12-09T13:50:51.644000Z",
    "edited": "2014-12-20T21:17:56.891000Z",
    "eye_color": "blue",
    "films": [
        {
            "id": 1,
            "title": "A New Hope"
        },
        {
            "id": 2,
            "title": "The Empire Strikes Back"
        },
        {
            "id": 3,
            "title": "Return of the Jedi"
        },
        {
            "id": 6,
            "title": "Revenge of the Sith"
        }
    ],
    "hair_color": "blond",
    "height": "172",
    "homeworld": {
        "id": 1,
        "name": "Tatooine"
    },
    "id": 1,
    "mass": "77",
    "name": "Luke Skywalker",
    "skin_color": "fair",
    "species": [],
    "starships": [
        {
            "id": 12,
            "name": "X-wing"
        },
        {
            "id": 22,
            "name": "Imperial shuttle"
        }
    ],
    "vehicles": [
        {
            "id": 14,
            "name": "Snowspeeder"
        },
        {
            "id": 30,
            "name": "Imperial Speeder Bike"
        }
    ]
}
```
