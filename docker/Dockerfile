FROM php:8.0-fpm

LABEL maintainer "Rauhann Chaves"

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
RUN groupadd -g ${GID} www
RUN useradd -u ${UID} -ms /bin/bash -g www www

# Configuração de timezone
RUN echo "America/Sao_Paulo" > /etc/timezone && \
    cp /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    rm -rf /var/cache/apt/* && \
    rm -rf /tmp/*

# Configuração de cron
COPY ./docker/cron/crontab /var/spool/cron/crontabs/root
RUN chmod -R 777 /var/spool/cron/crontabs

# Instalação do composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiando arquivos para container
COPY --chown=www:www . /app
COPY ./docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf
COPY ./docker/php/php-fpm-pool.conf /etc/php8/fpm/pool.d/www.conf
COPY ./docker/bash/entrypoint.sh /sbin/entrypoint.sh

USER www

EXPOSE 9000

ENTRYPOINT ["/sbin/entrypoint.sh"]

CMD ["true"]
