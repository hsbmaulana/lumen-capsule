FROM php:8.0-alpine as core

    ARG APP_TIMEZONE
    ARG APP_NAME
    ARG APP_MODE
    ARG APP_LOG_LEVEL
    ARG APP_HOST
    ARG APP_PORT

    ENV TZ=${APP_TIMEZONE}
    ENV APP_NAME=${APP_NAME}
    ENV APP_MODE=${APP_MODE}
    ENV APP_LOG_LEVEL=${APP_LOG_LEVEL}
    ENV APP_HOST=${APP_HOST}
    ENV APP_PORT=${APP_PORT}

    WORKDIR /var/www/${APP_NAME}/
    COPY . .

    RUN apk update \
        && \
        php -r $(echo "cmVhZGZpbGUoJ2h0dHA6Ly9nZXRjb21wb3Nlci5vcmcvaW5zdGFsbGVyJyk7Cg==" | base64 -d) | php -- --install-dir=/usr/bin/ --filename=$(echo "Y29tcG9zZXIK" | base64 -d) \
        && \
        apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS $(echo "dHpkYXRhIG5vZGVqcyBucG0gY3VybC1kZXYgbGliemlwLWRldiB6aXAgdW56aXAK" | base64 -d) \
        supervisor \
        apache2 apache2-utils apache2-ctl php8-apache2 apache2-proxy \
        freetype libjpeg-turbo libpng \
        freetype-dev libjpeg-turbo-dev libpng-dev \
        && \
        docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
        # --with-png=/usr/include/ \ #
        && \
        NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
        && \
        docker-php-ext-install -j${NPROC} zip gd curl bcmath pcntl sockets pdo pdo_mysql && pecl install -D 'enable-redis-igbinary="no" enable-redis-lzf="no" enable-redis-zstd="no"' -o -f redis && docker-php-ext-enable redis \
        && \
        apk del --no-cache freetype-dev libjpeg-turbo-dev libpng-dev && rm -rf /tmp/pear/ \
        && \
        ln -s /usr/lib/apache2 /etc/apache2/modules && mv .sock.json laravel-echo-server.json \
        && \
        if [ "${APP_MODE}" = "production" ]; then \
            cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" ; \
            echo "Set : php.ini-production" ; \
        else \
            cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" ; \
            echo "Set : php.ini-development" ; \
        fi \
        && \
        composer install --no-dev && npm install --production \
        && \
        npx laravel-echo-server client:add;

    EXPOSE ${APP_PORT}

    ENTRYPOINT []
    CMD ["supervisord", "-c", ".init.conf"]