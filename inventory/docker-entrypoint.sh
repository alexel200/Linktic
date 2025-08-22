#!/bin/bash
echo "Running database migrations..."
php artisan migrate --force
php artisan db:seed

echo "Starting web server..."

apache2-foreground
