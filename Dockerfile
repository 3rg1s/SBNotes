# Use an official PHP runtime as the base image
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install Apache2 and PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN apt-get update && apt-get upgrade -y && apt-get install -y default-mysql-client

# Copy the PHP project files to the container
COPY . .

# Configure Apache2
RUN a2enmod rewrite

# Update the Apache virtual host configuration
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Expose the port your PHP application uses (e.g., 80)
EXPOSE 80

# Start Apache2
CMD ["apache2-foreground"]
