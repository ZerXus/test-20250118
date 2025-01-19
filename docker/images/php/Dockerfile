FROM php:8.3.10-fpm-alpine3.20

ENV MUSL_LOCPATH /usr/share/locales/locales/musl

# Install dependencies
RUN apk --no-cache --update add  \
    $PHPIZE_DEPS \
#    pcre-dev \
    icu-dev \
#    cmake \
#    make \
#    musl-dev \
#    gcc \
#    gettext-dev \
#    libintl \
    build-base \
    linux-headers \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    curl \
    ca-certificates \
    bzip2 \
    libpng-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    fontconfig \
    libzip-dev \
    bzip2-dev \
    jpeg-dev \
    libpq-dev \
    libxml2-dev \
    iputils-ping \
    libwebp-dev \
    libsodium-dev \
    oniguruma-dev

## Install locales
#RUN wget https://gitlab.com/rilian-la-te/musl-locales/-/archive/master/musl-locales-master.zip \
#    && unzip musl-locales-master.zip \
#      && cd musl-locales-master \
#      && cmake -DLOCALE_PROFILE=OFF -D CMAKE_INSTALL_PREFIX:PATH=/usr . && make && make install \
#      && cd .. && rm -r musl-locales-master


RUN pecl channel-update pecl.php.net
# Install extensions
RUN docker-php-ext-install bcmath pdo_mysql zip exif pcntl pdo_pgsql pgsql soap bz2 calendar intl mysqli sockets
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install gd
RUN pecl install redis
RUN docker-php-ext-enable opcache redis

# Install composer
RUN curl -fsSL https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Dev
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

#RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
#RUN apt-get install -y nodejs

RUN apk add --update nodejs npm

RUN npm install --global yarn

# User
ARG UID
ARG GID

RUN apk --no-cache add shadow
RUN usermod -u ${UID} www-data
RUN groupmod -g ${GID} www-data
RUN apk del shadow

USER www-data
