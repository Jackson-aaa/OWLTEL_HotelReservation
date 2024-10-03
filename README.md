## Install dependencies
``composer install``

## Environment Setup
``cp .env.example .env``

## Initialize the database
Open the .env file and update the database configuration section with your environment details:

``DB_CONNECTION=mysql``

``DB_HOST=127.0.0.1``

``DB_PORT=3306``

``DB_DATABASE=OWLTEL``

``DB_USERNAME=root``

``DB_PASSWORD=``

## Run Migration

Migrate to database

``php artisan migrate``

Wipe out the database

``php artisan migrate:reset``

Rollback migration

``php artisan migrate:rollback``
