FROM serversideup/php:8.3-fpm-nginx AS laravel

WORKDIR /var/www/html

COPY --chown=www-data:www-data ./docker/etc/s6-overlay/s6-rc.d/laravel-queue /etc/s6-overlay/s6-rc.d/laravel-queue
COPY --chown=www-data:www-data ./docker/etc/s6-overlay/s6-rc.d/user/contents.d /etc/s6-overlay/s6-rc.d/user/contents.d

COPY --chown=www-data:www-data . .
COPY --chown=www-data:www-data ./.env.example ./.env

RUN touch storage/logs/laravel.log && chmod -R 775 storage/ && touch database/database.sqlite

# install vendor
RUN composer install --optimize-autoloader --no-interaction --no-plugins --no-scripts --prefer-dist --no-dev
# Standardport für Nginx und PHP-FPM
EXPOSE 8080
