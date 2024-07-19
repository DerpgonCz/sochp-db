## Development
### Prerequisites
- Docker
- Docker Compose
- Terminal
- Web browser

## Setup
### Initial
#### Linux
1. Clone the repository
    - `git clone URL`
2. Open the terminal
3. `cd` to the application root
4. Copy `.env` file
    - `cp .env.example .env`
5. (optional) Edit `.env` file to your liking
6. Run the services
    - Run in foreground: `sail up`
    - Run in background: `sail up -d`
7. Install dependencies
    - `sail composer install`
    - `sail yarn install`
8. Migrate the database
    - `sail artisan migrate`
9. (optional) Seed some test data
     - `sail artisan db:seed`      
10. Add auth key
    - `sail artisan key:generate`

#### Windows
I wish you good luck

### MeiliSearch
This project uses the [Laravel Scout](https://laravel.com/docs/8.x/scout) package to search models.
By default, it looks up models directly from the database.
To use the [MeiliSearch](https://www.meilisearch.com/) database to lookup models, there are a few necessasy steps.

1. Enable MeiliSearch integration
    - Uncomment these lines from `.env` file:
        - `SCOUT_DRIVER=meilisearch`
        - `MEILISEARCH_HOST=http://meilisearch:7700`
2. Import models
    - `sail artisan scout:import:all`

## Site links
- Main site: http://localhost/
- MeiliSearch: http://localhost:7700/
- Mailhog: http://localhost:7700/

## License
This project is open-sourced and licensed under the [MIT license](https://opensource.org/licenses/MIT).
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
