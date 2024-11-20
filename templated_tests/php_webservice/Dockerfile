# Use an official PHP runtime as a parent image
FROM php:8.0-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory in the container
WORKDIR /usr/src/app

# Copy the application code to the container
COPY . .

# Install any needed packages specified in composer.json
RUN composer install

# Install Xdebug
RUN pecl install xdebug-3.0.4 \
    && docker-php-ext-enable xdebug

# Expose the port the application will run on
EXPOSE 8080

# Define the command to run the Slim application
CMD ["php", "-S", "0.0.0.0:8080", "-t", "src/public/"]