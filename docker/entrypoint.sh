#!/bin/bash
set -e

cd /var/www/html

echo "Fixing permissions..."
chown -R www-data:www-data storage bootstrap/cache || true
chmod -R 775 storage bootstrap/cache || true

if [ ! -d "vendor" ]; then
  echo "Running composer install..."
  composer install --no-dev --optimize-autoloader
fi

if [ -z "$APP_KEY" ]; then
  echo "Generating APP_KEY..."
  php artisan key:generate
fi

php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true

exec apache2-foreground