FROM node:20-bookworm AS assets

WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY webpack.mix.js ./
RUN npm run production

FROM php:8.2-apache AS app

RUN apt-get update \
    && apt-get install -y --no-install-recommends default-mysql-client libzip-dev unzip \
    && docker-php-ext-install pdo_mysql zip \
    && a2enmod rewrite headers \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY --chown=www-data:www-data . .
COPY --from=assets --chown=www-data:www-data /app/public ./public
COPY docker/app/entrypoint.sh /usr/local/bin/swapi-entrypoint

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader \
    && chmod +x /usr/local/bin/swapi-entrypoint \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

ENTRYPOINT ["swapi-entrypoint"]
CMD ["apache2-foreground"]
