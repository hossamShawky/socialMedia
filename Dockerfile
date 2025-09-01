# Stage 1: Build
FROM php:8.2-fpm-alpine as build

# Install system dependencies
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    libxpm-dev \
    zlib-dev \
    libzip-dev \
    git \
    bash \
    unzip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy the application code
COPY . .

# Install PHP extensions with proper configuration
RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-xpm --with-freetype && \
    docker-php-ext-install gd zip pdo pdo_mysql

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Stage 2: Production
FROM php:8.2-fpm-alpine

# Install runtime dependencies
RUN apk add --no-cache \
    libpng \
    libjpeg-turbo \
    freetype \
    libwebp \
    libxpm \
    zlib \
    libzip

# Copy only necessary files from the build stage
COPY --from=build /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/
COPY --from=build /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=build /var/www /var/www

# Set working directory
WORKDIR /var/www

# Set environment variables
ENV APP_ENV=production
ENV APP_DEBUG=false

# Ensure storage and bootstrap/cache are writable
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port
EXPOSE 8000

# Start the PHP-FPM server
CMD ["php-fpm"]

