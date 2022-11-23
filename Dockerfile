# Dockerfile
FROM php:7.4.1-fpm
# # Install Composer
# Add docker php ext repo
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mbstring pdo_mysql zip exif pcntl gd memcached && \

# Install dependencies
  apt-get update && apt-get install -y \
    zip \
    unzip && \
    php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer;
# RUN composer require --dev phpunit/phpunit ^9.5
