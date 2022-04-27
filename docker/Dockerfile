FROM php:8.0-fpm

# Autor do arquivo
LABEL maintainer "Rauhann Chaves (https://github.com/Rauhann)"

# Usuário host
ARG UID=1000
ARG GID=1000

# Setando diretorio
WORKDIR /app

# Dependencias PHP
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mbstring pdo_mysql zip exif pcntl gd

# Dependencias PHP e Servidor
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    cron \
    supervisor

# Sincroniza usuário e grupo com o host
RUN groupadd -g ${GID} nginx && \
    useradd -u ${UID} -ms /bin/bash -g nginx nginx

# Configuração de cron
COPY ./docker/cron/crontab /etc/cron.d/crontab
RUN chmod 0644 /etc/cron.d/crontab && \
    crontab /etc/cron.d/crontab

# Instalação do composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.2.12

# Copiando arquivos para container
COPY --chown=nginx:nginx . /app
COPY ./docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf
COPY ./docker/bash/entrypoint.sh /sbin/entrypoint.sh

# Expondo porta de serviço PHP
EXPOSE 9000

# Script para inicialização
ENTRYPOINT ["/sbin/entrypoint.sh"]
