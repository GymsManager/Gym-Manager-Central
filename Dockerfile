# Dockerfile
FROM php:8.2-apache

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy custom Apache config
COPY apache/laravel.conf /etc/apache2/sites-available/000-default.conf
COPY apache/laravel-ssl.conf /etc/apache2/sites-available/default-ssl.conf


RUN a2enmod rewrite
RUN a2enmod env

RUN a2enmod ssl && a2ensite default-ssl

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY . .

# Install Composer dependencies (important!)
RUN composer install --no-dev --optimize-autoloader

# Copy production compose file
COPY docker-compose.prod.yml ./

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
