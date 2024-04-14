FROM php:8.3-fpm-alpine

RUN apk add --no-cache openssl \
            postgresql-dev\
            bash \
            nodejs \
            npm \
            freetype-dev \
            libjpeg-turbo-dev \
            libpng-dev \
            zlib
            
RUN docker-php-ext-install bcmath && \
        docker-php-ext-install gd && \
        docker-php-ext-install pdo pdo_pgsql

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

WORKDIR /var/www

RUN rm -rf /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN ln -s public html

EXPOSE 9000

ENTRYPOINT ["php-fpm"]