FROM php:latest

# Установка скрипта, позволяющего легко добавлять расширения
RUN curl -sSLf -o /usr/local/bin/install-php-extensions \
    https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions && \
    chmod +x /usr/local/bin/install-php-extensions

# Установка symfony
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt-get update && apt-get -y install apt-utils symfony-cli

# Установка зависимостей
RUN install-php-extensions @composer xdebug zip pdo_pgsql pgsql intl gd

# Дополнительные настройки php
COPY ./php.ini /usr/local/etc/php/conf.d/php.ini
