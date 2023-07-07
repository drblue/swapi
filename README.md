# StarWars API

Laravel-clone of swapi.dev, but with improved relationships.

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

8. Import the database dump from `database/dump.sql`

9. Validate the database connection by running

    ```bash
    php artisan migrate
    ```

10. Start the local development server

    ```bash
    php artisan serve
    ```

11. Visit [http://localhost:8000/api/](http://localhost:8000/api/) in your browser

## Usage

Endpoints are available at `/api/` and are documented below.

All index resources return only relationship counts. To get the full relationship (`id` and `name`/`title`), you must use the `GET /api/{resource}/{id}` endpoint.

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
