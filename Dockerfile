# ============================================================
# XL SATU Sales — Dockerfile (Render Web Service ready)
# PHP-FPM + Nginx, listens on $PORT (set by Render).
# ============================================================

# ---------- Stage 1: Build frontend assets (Vite) ----------
FROM node:22-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json vite.config.js ./
COPY resources ./resources

RUN npm ci && npm run build

# ---------- Stage 2: Install PHP dependencies ----------
FROM composer:2 AS vendor

WORKDIR /app

COPY . .

# Remove the committed package/service manifests: they list dev-only
# packages (laravel/pail, sail, collision, termwind) which are NOT
# installed with --no-dev. Leaving them in place makes the app boot
# fail with "Class not found" (both here and at runtime).
RUN rm -f bootstrap/cache/packages.php bootstrap/cache/services.php

RUN composer install \
        --no-dev \
        --no-interaction \
        --prefer-dist \
        --optimize-autoloader

# ---------- Stage 3: Runtime (PHP-FPM + Nginx) ----------
FROM php:8.3-fpm-alpine

# System + PHP extensions (MySQL, PostgreSQL, images, intl, zip, opcache)
RUN apk add --no-cache \
        nginx \
        gettext \
        icu-libs \
        libpng \
        libjpeg-turbo \
        freetype \
        libpq \
        libzip \
        oniguruma \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        icu-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        libpq-dev \
        libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        exif \
        gd \
        intl \
        opcache \
        pcntl \
        pdo_mysql \
        pdo_pgsql \
        zip \
    && docker-php-ext-enable opcache \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

WORKDIR /var/www/html

# Copy compiled frontend assets
COPY --from=assets /app/public/build ./public/build

# Copy PHP production config
COPY docker/php.ini /usr/local/etc/php/conf.d/zz-app.ini

# Copy the application source (vendor / node_modules / .env are dockerignored)
COPY . .

# Remove stale package/service manifests (committed in git with dev-only
# packages like pail/sail/collision) and rebuild them against the
# production vendor (--no-dev). services.php is regenerated on first boot.
RUN rm -f bootstrap/cache/packages.php bootstrap/cache/services.php \
    && php artisan package:discover --ansi

# Copy Nginx site template (PORT is substituted at runtime)
COPY docker/nginx/default.conf.template /etc/nginx/http.d/default.conf.template
RUN rm -f /etc/nginx/http.d/default.conf

# Prepare Laravel writable directories
RUN mkdir -p \
        storage/app/public \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R u+rwX,go+rX storage bootstrap/cache

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 8080

ENTRYPOINT ["docker-entrypoint.sh"]
