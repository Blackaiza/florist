FROM php:8.3-apache

ENV DEBIAN_FRONTEND=noninteractive

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    libicu-dev zip curl \
    && docker-php-ext-install \
        pdo pdo_mysql mbstring exif pcntl bcmath gd intl zip calendar \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Set Apache document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# Copy composer binary from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Ensure storage and bootstrap/cache exist and are writable
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose HTTP port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]