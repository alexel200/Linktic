#!/bin/bash
echo "Running database migrations..."
php artisan migrate --force

echo "Starting web server..."
# The command to start your web server, e.g.,
php-fpm # for a typical Laravel setup with Nginx
# or
apache2-foreground # if using an Apache base image
