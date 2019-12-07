FROM php:7

# For composer
RUN apt-get update \
    && apt-get install -y zlib1g-dev wget libzip-dev \
    && docker-php-ext-install zip

# Install composer
RUN EXPECTED_SIGNATURE="$(wget -q -O - https://composer.github.io/installer.sig)" \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && ACTUAL_SIGNATURE="$(php -r "echo hash_file('sha384', 'composer-setup.php');")" \
    && if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]; then \
    >&2 echo 'ERROR: Invalid installer signature' \
    rm composer-setup.php \
    exit 1; fi \
    && php composer-setup.php --quiet \
    && RESULT=$? \
    && rm composer-setup.php \
    && mv composer.phar /usr/local/bin/composer

# Set composer environment
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

# Install laravel installer
RUN composer global require "laravel/installer"

# PHP's DB setting
RUN apt-get update \
     && apt-get install -y libpq-dev \
     && docker-php-ext-install pdo_pgsql

# Install Node.js
RUN apt-get install -y --no-install-recommends gcc make libpng-dev
RUN apt-get install -y curl software-properties-common gnupg
RUN curl -sL https://deb.nodesource.com/setup_9.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs

# Install vim
RUN apt-get install -y vim

# Install xdebug
ARG INSTALL_XDEBUG=false

RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    pecl install xdebug \
;fi
    
WORKDIR /var/www