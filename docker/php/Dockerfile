FROM php:8.2-fpm
RUN apt-get update

# postgres extension
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql && \
        apt-get install -y git

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install zip

RUN \
    apt-get install git unzip wait-for-it wget libicu-dev -y && \
    docker-php-ext-install intl pdo_mysql && \
    echo 'extension=intl.so' > /usr/local/etc/php/conf.d/docker-php-ext-intl.ini && \
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /app


RUN useradd -u 1000 -m user

RUN chown user:user /app

USER user



WORKDIR /app