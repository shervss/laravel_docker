FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libpq-dev \
    libicu-dev \
    && docker-php-ext-install pdo pdo_mysql gd bcmath zip opcache intl \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /usr/share/nginx/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

COPY ./scripts/php-fpm-entrypoint /usr/local/bin/php-entrypoint

RUN chmod +x /usr/local/bin/php-entrypoint

ENTRYPOINT ["php-entrypoint"]

CMD ["php-fpm"]