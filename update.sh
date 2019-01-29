#!/bin/sh
cd -- "$(dirname "$BASH_SOURCE")"

echo "Pulling project..."
git pull

echo "Installing dependencies..."
composer install

echo "Migrating database..."
php artisan migrate
