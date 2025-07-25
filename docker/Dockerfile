FROM php:7.0-apache

# Замінюємо джерела APT на archive.debian.org і вимикаємо перевірку підписів
RUN sed -i 's|deb.debian.org|archive.debian.org|g' /etc/apt/sources.list && \
    sed -i '/stretch-updates/d' /etc/apt/sources.list && \
    sed -i 's|security.debian.org|archive.debian.org|g' /etc/apt/sources.list && \
    echo 'Acquire::Check-Valid-Until "false";\nAcquire::AllowInsecureRepositories "true";\nAPT::Get::AllowUnauthenticated "true";' > /etc/apt/apt.conf.d/99insecure

# Встановлюємо залежності (ігноруємо перевірку підписів)
RUN apt-get update && \
    apt-get -o Acquire::AllowInsecureRepositories=true -o APT::Get::AllowUnauthenticated=true install -y \
        libpng-dev libjpeg-dev libfreetype6-dev zip unzip git curl && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install pdo pdo_mysql mbstring gd

# Включаємо Apache mod_rewrite
RUN a2enmod rewrite

# Встановлення Composer 2.2 LTS (сумісний з PHP 7.0)
RUN curl -sS https://getcomposer.org/installer | php -- --version=2.2.21 && \
    mv composer.phar /usr/local/bin/composer

# Налаштовуємо DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

WORKDIR /var/www/html
