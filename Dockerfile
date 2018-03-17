FROM php:7.2-apache

# install git & zip
RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip unzip

RUN apt-get install -y zlib1g-dev \
    && docker-php-ext-install zip

# install composer
RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer