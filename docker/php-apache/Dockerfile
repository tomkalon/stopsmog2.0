FROM php:8.3-apache-bullseye

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Apache config
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && a2enmod rewrite

# System deps + PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
        libicu-dev \
        libzip-dev \
        zip \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
        libwebp-dev \
        curl \
        git \
        unzip \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install intl opcache pdo_mysql zip gd \
    && rm -rf /var/lib/apt/lists/*

# PHP ini
RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

# Xdebug (dev)
RUN apt-get update && apt-get install -y --no-install-recommends $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apt-get purge -y --auto-remove $PHPIZE_DEPS \
    && rm -rf /var/lib/apt/lists/*

COPY xdebug.ini $PHP_INI_DIR/conf.d/99-xdebug.ini

# OPCache
COPY opcache.ini $PHP_INI_DIR/conf.d/docker-php-ext-opcache.ini

# APCu
RUN apt-get update && apt-get install -y --no-install-recommends $PHPIZE_DEPS \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && apt-get purge -y --auto-remove $PHPIZE_DEPS \
    && rm -rf /var/lib/apt/lists/*

RUN { \
    echo "apc.enable=1"; \
    echo "apc.enable_cli=1"; \
} > /usr/local/etc/php/conf.d/apcu.ini

# Apache vhost
COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

# Composer (bezpieczna instalacja)
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

# Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Tools
RUN apt-get update && apt-get install -y --no-install-recommends \
        nano \
        mc \
    && rm -rf /var/lib/apt/lists/*

# History (dev convenience)
RUN echo "composer install" >> ~/.bash_history \
    && echo "composer update" >> ~/.bash_history \
    && echo "symfony console" >> ~/.bash_history \
    && echo "symfony console fos:js-routing:dump --format=json --target=public/js/routes.json" >> ~/.bash_history \
    && echo "bin/console doctrine:migrations:diff" >> ~/.bash_history \
    && echo "bin/console doctrine:migrations:migrate" >> ~/.bash_history \
    && echo "bin/console app:admin:add" >> ~/.bash_history