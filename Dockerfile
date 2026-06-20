FROM php:8.2-apache

# Install system dependencies including PostgreSQL dev libraries
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    nodejs \
    npm

# Install PHP extensions - pdo_pgsql requires libpq-dev above
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install and build frontend assets
RUN npm install && npm run build

# Set Apache to serve from /public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Run migrations and start Apache
CMD php artisan view:clear && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan cache:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan storage:link && \
    apache2-foreground


# Install and build frontend assets
RUN npm install && npm run build

# DEBUG: list what's actually in public/ after build
RUN ls -la /var/www/html/public/css/ || echo "css folder missing!"
RUN ls -la /var/www/html/public/js/ || echo "js folder missing!"