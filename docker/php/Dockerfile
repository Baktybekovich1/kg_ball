# Установка PHP
# Используем официальный образ PHP 8.2
FROM php:8.2-fpm

# Обновление и установка необходимых зависимостей
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    wget \
    libzip-dev \
    libicu-dev \
    curl && \
    docker-php-ext-install pdo pdo_pgsql zip intl

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Установка Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Создание пользователя и установка прав
RUN useradd -u 1000 -m user
USER user

# Устанавливаем рабочую директорию
WORKDIR /app

# Команда запуска Symfony сервера
CMD ["symfony", "server:start", "--no-tls", "--port=8000", "--allow-all-ip", "--listen-ip=0.0.0.0"]

