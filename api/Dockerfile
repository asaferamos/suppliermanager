FROM php:7.1-fpm
RUN docker-php-ext-install mysqli pdo_mysql

RUN apt-get update \
    apt-get upgrade \
    apt-get install zip git -y

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/bin \
    --filename=composer

WORKDIR /var/www/html