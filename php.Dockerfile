FROM php:8.1-fpm

#Configurações iniciais 
RUN apt-get update
RUN apt-get install -y libpq-dev 
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

#Instalação driver postgres
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pgsql
RUN docker-php-ext-install pdo_pgsql

#Instalação Xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
COPY ./xdebug.ini /usr/local/etc/php/conf.d/


WORKDIR /var/www