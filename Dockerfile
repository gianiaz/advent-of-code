FROM php:7.3.0-cli-alpine

RUN docker-php-ext-install -j5 \
        opcache
RUN echo "opcache.enable_cli=0" > /usr/local/etc/php/conf.d/opcache.ini
#RUN apk add --no-cache $PHPIZE_DEPS
#RUN pecl install ds
