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

echo "==> Waiting for MySQL to wake up (this may take 30-60 seconds)..."
MAX_TRIES=60
COUNT=0
until mysqladmin ping -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USERNAME" -p"$DB_PASSWORD" --silent 2>/dev/null; do
    COUNT=$((COUNT+1))
    if [ $COUNT -ge $MAX_TRIES ]; then
        echo "MySQL never woke up after ${MAX_TRIES} attempts. Starting anyway..."
        break
    fi
    echo "    MySQL sleeping... attempt $COUNT/$MAX_TRIES (waiting 3s)"
    sleep 3
done
echo "==> MySQL is ready!"

echo "==> Starting PHP-FPM..."
php-fpm -D

echo "==> Starting nginx..."
nginx -g "daemon off;"