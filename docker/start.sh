#!/bin/bash
set -e

echo "==> Setting permissions..."
chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache

echo "==> Clearing caches..."
php artisan view:clear
php artisan config:clear
php artisan route:clear
php artisan cache:clear

echo "==> Caching config and routes..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Waiting for MySQL to be ready..."
until php artisan migrate --force 2>&1; do
    echo "    MySQL not ready yet, retrying in 3s..."
    sleep 3
done

echo "==> Starting PHP-FPM..."
php-fpm -D

echo "==> Starting nginx..."
nginx -g "daemon off;"