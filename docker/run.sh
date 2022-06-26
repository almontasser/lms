#!/bin/sh

cd /var/www

php artisan migrate
php artisan index:content
php artisan cache:clear
php artisan route:cache
