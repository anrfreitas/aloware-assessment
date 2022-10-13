#!/usr/bin/env sh

cp .env.example .env &&
composer install &&
php artisan key:generate &&
php artisan migrate:fresh &&
php artisan db:seed &&
php artisan serve --port=9010 --host=0.0.0.0
