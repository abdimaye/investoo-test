## Backend Test

This is implemented in Laravel 5.4.

## Despendencies

Use composer: `composer require`

## Configuration

### Environment

Rename the '.env.example' file to just '.env'. Enter your credentials for DB_HOST, DB_PORT, DB_DATABASE (be sure to create this first), DB_USERNAME, DB_PASSWORD.

### Migration

Create the database tables: `php artisan migrate`

### Server

Use the built in server: `php artisan serve`

## Automated tests

I created a few tests just for demo. 

Run these: `vendor/bin/phpunit`

All 4 tests should pass.

## Structure

Check the following paths for the code review:
* app/investoo
* app/http/controllers/FileController.php
* database/factories/ModelFactory.php
* routes/api.php
* tests/feature

## API routes
* post: /api
* get all records: /api
* get specific resource: /api/{id}
* download specific file: /api/download/{id}
