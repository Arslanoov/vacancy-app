FROM php:7.4-cli-alpine

RUN apk add --no-cache autoconf g++ make \
    && pecl install xdebug \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

RUN apk add --no-cache postgresql-dev bash coreutils \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql

RUN apk add --no-cache unzip

COPY ./common/wait-for-it.sh /usr/local/bin/wait-for-it
RUN chmod 555 /usr/local/bin/wait-for-it

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet \
    && composer global require hirak/prestissimo --no-plugins --no-scripts --ignore-platform-reqs \
    && rm -rf /root/.composer/cache

WORKDIR /app
