# Use the official PHP Apache image
FROM php:8.2-apache

# Enable Apache mod_rewrite (commonly needed for PHP apps)
RUN a2enmod rewrite

# Copy project files into the Apache web directory
COPY . /var/www/html/

# Set file permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (standard HTTP port)
EXPOSE 80
