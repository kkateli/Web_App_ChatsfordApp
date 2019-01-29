#!/bin/sh
cd -- "$(dirname "$BASH_SOURCE")"

echo "Putting application in maintenance mode..."
php artisan down

echo "Pulling project..."
git pull

echo "Installing dependencies..."
composer install

echo "Migrating database..."
php artisan migrate --force

echo "Caching routes..."
php artisan route:cache

echo "Caching config..."
php artisan config:cache

echo "Bringing application back up..."
php artisan up
