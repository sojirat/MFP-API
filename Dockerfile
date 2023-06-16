# Use the official PHP 8.2 Alpine image as the base image
FROM php:8.2-alpine

# Set the working directory inside the container
WORKDIR /var/www/html

# Install system dependencies
RUN apk update && apk add --no-cache \
    git \
    zip \
    unzip \
    libzip-dev \
    oniguruma-dev \
    libxml2-dev \
    libpng-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clone the Laravel project from local
COPY ./ /var/www/html/

# Install composer dependencies
RUN composer install --no-interaction --no-scripts --no-dev --prefer-dist

# Generate Laravel application key
RUN php artisan key:generate

# Set directory permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 for the web server
EXPOSE 80

# Start the PHP built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]