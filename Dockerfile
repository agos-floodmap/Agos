FROM php:8.3-apache

# Enable Apache mod_rewrite for clean URLs/routing
RUN a2enmod rewrite

# Install PostgreSQL PDO extension in case PHP connects directly to Supabase
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Copy project files into Apache web root
COPY . /var/www/html/

# Ensure Apache serves from /var/www/html cleanly
WORKDIR /var/www/html

EXPOSE 80