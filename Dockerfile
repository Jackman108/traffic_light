FROM php:8.1-apache

# Установка расширений PHP
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-configure pdo_pgsql && \
    docker-php-ext-install pdo pdo_pgsql


# Копирование файлов Laravel
COPY . /var/www/html

# Установка прав доступа
RUN chown -R www-data:www-data /var/www/html && \
    a2enmod rewrite && \
    service apache2 restart
