# Use PHP 8.1 with Apache
FROM php:8.1-apache

# Install mysqli
RUN docker-php-ext-install mysqli

# Enable mod_rewrite (optional for .htaccess or pretty URLs)
RUN a2enmod rewrite

# Copy your app into the Apache document root
COPY . /var/www/html/

# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html

# Expose web port
EXPOSE 80
