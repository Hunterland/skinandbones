FROM php:7.3-apache

RUN apt-get update --fix-missing
RUN apt-get install -y curl
RUN apt-get install libldap2-dev -y
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev

COPY ./app /var/www/html
#COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd
    
RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap

RUN docker-php-ext-install mbstring mysqli pdo pdo_mysql bcmath\
    && chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite && service apache2 restart

RUN echo "session.save_path=\"/tmp\"" >> /usr/local/etc/php/conf.d/session.ini

