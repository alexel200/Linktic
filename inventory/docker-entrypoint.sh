#!/bin/bash
echo "Running database migrations..."
php artisan migrate --force

echo "Starting web server..."

apache2-foreground
