# Установка PHP
FROM php:8.2-fpm

# Обновление и установка зависимостей
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    wget \
    libzip-dev \
    libicu-dev

# Установка расширений PHP
RUN docker-php-ext-install pdo pdo_pgsql zip intl

# Установка Composer
USER root
RUN curl -sS https://getcomposer.org/installer | php && \
    chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Переход на пользователя
RUN useradd -u 1000 -m user
USER user

WORKDIR /app
