# Use PHP 8.1 with Apache
FROM php:8.1-apache

# Install mysqli
RUN docker-php-ext-install mysqli

# Enable mod_rewrite
RUN a2enmod rewrite

# Copy your app into the Apache document root
COPY . /var/www/html/

# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html

# Set environment variables (only for testing — NOT recommended for production)
ENV DB_HOST=192.185.48.158
ENV DB_USER=bisublar_clinic
ENV DB_PASS=Cl1n1c2025@
ENV DB_NAME=bisublar_clinic

# Expose web port
EXPOSE 80
