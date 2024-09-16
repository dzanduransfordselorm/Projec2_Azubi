# Use the official PHP image as the base image
FROM php:8.2-cli

# Copy the PHP file to the /var/www/html/ directory
COPY . /var/www/html/

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
