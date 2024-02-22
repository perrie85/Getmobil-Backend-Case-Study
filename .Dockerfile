# Use the official PHP 8.1 image based on Alpine Linux
FROM php:8.2-alpine

# Set working directory
WORKDIR /var/www/html

# Install autoconf, install mongodb extension, delete autoconf
RUN apk --update add --virtual build-dependencies build-base openssl-dev autoconf \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && pecl install -o -f redis \
    && docker-php-ext-enable redis \
    && apk del build-dependencies build-base openssl-dev autoconf

# Install system dependencies
RUN apk update && apk add --no-cache \
    git \
    libpng \
    libpng-dev \
    libjpeg-turbo \
    libjpeg-turbo-dev \
    openssl \
    libzip \
    libzip-dev

# Remove cached package files
RUN rm -rf /var/cache/apk/*

# Install PHP extensions
RUN docker-php-ext-install gd pdo_mysql mysqli zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader
