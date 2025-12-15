FROM php:8.2-apache
LABEL authors="Filip Rund"
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    curl \
    git \
    libjpeg-dev \
    libonig-dev \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    libzip-dev \
    npm \
    unzip \
    zip \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    xml \
    gd \
    zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \
    && cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini \
    && sed -zi 's/post_max_size = 8M/post_max_size = 256M/' /usr/local/etc/php/php.ini \
    && echo 'upload_max_filesize = 256M' >> /usr/local/etc/php/php.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY . /var/www/html
RUN a2enmod rewrite
EXPOSE 80
CMD ["apache2-foreground"]
