# Use PHP 8.2 FPM Alpine for smaller image size
FROM php:8.2-fpm-alpine

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
    nodejs \
    npm \
    nginx \
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

# Copy package files first for better caching
COPY package*.json ./

# Install npm dependencies
RUN npm install

# Copy application files
COPY . .

# Create storage directories
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p storage/app/temp \
    && mkdir -p bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Build frontend assets (skip on error if not needed)
RUN npm run production || echo "Skipping npm build - using existing assets"

# Create nginx config
RUN echo 'server {' > /etc/nginx/http.d/default.conf && \
    echo '    listen 8080;' >> /etc/nginx/http.d/default.conf && \
    echo '    root /var/www/html/public;' >> /etc/nginx/http.d/default.conf && \
    echo '    index index.php index.html;' >> /etc/nginx/http.d/default.conf && \
    echo '    charset utf-8;' >> /etc/nginx/http.d/default.conf && \
    echo '    client_max_body_size 20M;' >> /etc/nginx/http.d/default.conf && \
    echo '' >> /etc/nginx/http.d/default.conf && \
    echo '    location / {' >> /etc/nginx/http.d/default.conf && \
    echo '        try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/http.d/default.conf && \
    echo '    }' >> /etc/nginx/http.d/default.conf && \
    echo '' >> /etc/nginx/http.d/default.conf && \
    echo '    location = /favicon.ico { access_log off; log_not_found off; }' >> /etc/nginx/http.d/default.conf && \
    echo '    location = /robots.txt  { access_log off; log_not_found off; }' >> /etc/nginx/http.d/default.conf && \
    echo '' >> /etc/nginx/http.d/default.conf && \
    echo '    location ~ \.php$ {' >> /etc/nginx/http.d/default.conf && \
    echo '        fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/http.d/default.conf && \
    echo '        fastcgi_index index.php;' >> /etc/nginx/http.d/default.conf && \
    echo '        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;' >> /etc/nginx/http.d/default.conf && \
    echo '        include fastcgi_params;' >> /etc/nginx/http.d/default.conf && \
    echo '        fastcgi_hide_header X-Powered-By;' >> /etc/nginx/http.d/default.conf && \
    echo '    }' >> /etc/nginx/http.d/default.conf && \
    echo '' >> /etc/nginx/http.d/default.conf && \
    echo '    location ~ /\.(?!well-known).* {' >> /etc/nginx/http.d/default.conf && \
    echo '        deny all;' >> /etc/nginx/http.d/default.conf && \
    echo '    }' >> /etc/nginx/http.d/default.conf && \
    echo '}' >> /etc/nginx/http.d/default.conf

# Create storage link
RUN php artisan storage:link || true

# Set proper permissions  
RUN chmod -R 777 storage bootstrap/cache public

# Expose port
EXPOSE 8080

# Create startup script
RUN echo '#!/bin/sh' > /start.sh && \
    echo 'set -e' >> /start.sh && \
    echo 'echo "Starting PHP-FPM..."' >> /start.sh && \
    echo 'php-fpm -D' >> /start.sh && \
    echo 'echo "Clearing cache..."' >> /start.sh && \
    echo 'rm -rf bootstrap/cache/*.php || true' >> /start.sh && \
    echo 'php artisan config:clear || true' >> /start.sh && \
    echo 'php artisan cache:clear || true' >> /start.sh && \
    echo 'php artisan view:clear || true' >> /start.sh && \
    echo 'echo "Testing database connection..."' >> /start.sh && \
    echo 'php artisan tinker --execute="try { DB::connection()->getPdo(); echo \"Database connected successfully\"; } catch (Exception \$e) { echo \"Database connection failed: \" . \$e->getMessage(); }"' >> /start.sh && \
    echo 'echo "Running database migrations..."' >> /start.sh && \
    echo 'php artisan migrate --force || true' >> /start.sh && \
    echo 'echo "Caching configuration..."' >> /start.sh && \
    echo 'echo "APP_URL: $APP_URL"' >> /start.sh && \
    echo 'echo "Asset URL: $(php artisan tinker --execute="echo config(\"app.url\");")"' >> /start.sh && \
    echo 'php artisan config:cache || true' >> /start.sh && \
    echo 'php artisan route:cache || true' >> /start.sh && \
    echo 'php artisan view:cache || true' >> /start.sh && \
    echo 'echo "Starting Nginx on port 8080..."' >> /start.sh && \
    echo 'nginx -g "daemon off;"' >> /start.sh && \
    chmod +x /start.sh

# Start application
CMD ["/start.sh"]

