## Comment Application

## Instruction
- Clone the repository
- docker-compose build && docker-compose up -d
- docker-compose exec app /bin/bash
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate
- php artisan db:seed

## Note
- The application is running on port 80
- The database is running on port 3306
- The application is running on http://localhost
- Testing output in Screenshot ``` 2025-01-17 at 5.11.30 PM.png in root directory ```
- Video recording in Screen Recording ``` 2025-01-17 at 5.09.29 PM.mov in root directory ```
- PEST using Test
- Postman Collection in root directory ``` API Documentation #reference.postman_collection.json ```
