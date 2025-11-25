# Use PHP 8.2 CLI Alpine for smaller image size
FROM php:8.2-cli-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libzip-dev \
    zip \
    unzip \
    mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Create storage directories
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Laravel optimization
RUN php artisan config:clear || true \
    && php artisan cache:clear || true \
    && php artisan view:clear || true \
    && php artisan route:clear || true

# Generate application key if not set
RUN php artisan key:generate --force || true

# Cache for production
RUN php artisan config:cache || true \
    && php artisan route:cache || true \
    && php artisan view:cache || true

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 8080

# Start PHP built-in server
CMD php artisan serve --host=0.0.0.0 --port=8080

