#!/bin/sh

cd /var/www

composer install --optimize-autoloader --no-dev
php artisan migrate
php artisan index:content
php artisan cache:clear
php artisan route:cache
php-fpm
