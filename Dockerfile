FROM php:8.2.0-fpm

RUN apt-get update \
  && apt-get install --no-install-recommends -y \
  cron \
  icu-devtools \
  jq \
  libfreetype6-dev libicu-dev libjpeg62-turbo-dev libpng-dev libpq-dev \
  libsasl2-dev libssl-dev libwebp-dev libxpm-dev libzip-dev libzstd-dev \
  unzip \
  zlib1g-dev \
  && apt-get clean \
  && apt-get autoclean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini \
  && pecl install --configureoptions='enable-redis-igbinary="yes" enable-redis-lzf="yes" enable-redis-zstd="yes"' igbinary zstd redis \
  && pecl clear-cache \
  && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
  && docker-php-ext-install gd intl pdo_mysql pdo_pgsql zip \
  && docker-php-ext-enable igbinary opcache redis zstd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# ------------

# FROM php:7.4-apache

# WORKDIR /var/www/laravel

# RUN curl -o /usr/local/bin/composer https://getcomposer.org/download/latest-stable/composer.phar \
#     && chmod +x /usr/local/bin/composer

# # hadolint ignore=DL3008
# RUN apt-get update \
#     && apt-get install --no-install-recommends -y \
#     cron \
#     icu-devtools \
#     jq \
#     libfreetype6-dev libicu-dev libjpeg62-turbo-dev libpng-dev libpq-dev \
#     libsasl2-dev libssl-dev libwebp-dev libxpm-dev libzip-dev libzstd-dev \
#     unzip \
#     zlib1g-dev \
#     && apt-get clean \
#     && apt-get autoclean \
#     && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# # hadolint ignore=DL3059
# RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini \
#     && pecl install --configureoptions='enable-redis-igbinary="yes" enable-redis-lzf="yes" enable-redis-zstd="yes"' igbinary zstd redis \
#     && pecl clear-cache \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
#     && docker-php-ext-install gd intl pdo_mysql pdo_pgsql zip \
#     && docker-php-ext-enable igbinary opcache redis zstd

# COPY composer.json composer.lock ./

# COPY docker/ /

# COPY . /var/www/laravel

# CMD ["docker-laravel-entrypoint"]
