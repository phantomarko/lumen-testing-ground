FROM php:8-fpm

WORKDIR /var/www/

RUN apt-get update -y && apt-get upgrade -y
RUN apt-get install -y build-essential libzip-dev \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libonig-dev zip jpegoptim optipng pngquant \
    gifsicle vim git curl libcurl4-openssl-dev \
    pkg-config libssl-dev

RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN pecl config-set php_ini /etc/php.ini

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo_mysql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# RUN  apt-get install -y ufw
# RUN ufw allow 9003
COPY .docker/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY . /var/www/

EXPOSE 9000

CMD ["php-fpm"]
