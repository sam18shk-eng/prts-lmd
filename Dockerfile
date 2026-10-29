FROM php:8.3-apache

# Install dependencies sistem yang dibutuhin Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file project
COPY . /var/www/html

# INSTALL COMPOSER DEPENDENCIES (Ini yang tadi kurang!)
RUN composer install --no-dev --optimize-autoloader

# Set permission buat storage & bootstrap cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Ubah document root apache ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html/!${APACHE_DOCUMENT_ROOT}/!g' /etc/apache2/sites-available/*.conf

RUN a2enmod rewrite

EXPOSE 80