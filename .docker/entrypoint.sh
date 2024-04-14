#!/bin/bash

chmod -R 777 /var/www/storage  
composer install
php artisan key:generate
php artisan migrate

php-fpm