FROM php:8.3-fpm

# 1. Kerakli dev paketlarni o'rnatamiz (build vaqti uchun)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. GD ni to'g'ri sozlab o'rnatamiz (PHP 8.3 uchun sintaksis shu)
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp \
 && docker-php-ext-install -j$(nproc) gd

# Qolgan qismlar (sizniki)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Composer o'rnatish (agar kerak bo'lsa --no-dev bilan)
RUN composer install --optimize-autoloader --no-dev

EXPOSE 9000

CMD ["php-fpm"]