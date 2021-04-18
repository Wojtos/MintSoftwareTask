FROM php:8-cli-alpine

COPY . /usr/src/app
WORKDIR /usr/src/app

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
RUN composer install
RUN ./vendor/bin/phpunit test

CMD [ "php", "./src/app.php" ]