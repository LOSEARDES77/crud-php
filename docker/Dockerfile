FROM php:8.3-apache
ENV DEBIAN_FRONTEND=noninteractive
RUN apt update
RUN apt -y install vim

RUN echo "<Directory /var/www/html>" >> /etc/apache2/apache2.conf
RUN echo "Options +Indexes"  >> /etc/apache2/apache2.conf
RUN echo "</Directory>"  >> /etc/apache2/apache2.conf

 # Instalar Xdebug
 RUN pecl install xdebug \
     && docker-php-ext-enable xdebug


 # Configuración de Xdebug
 RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" >> /usr/local/etc/php/conf.d/xdebug.ini \
     && echo "xdebug.remote_enable=true" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN echo "ErrorLog ${APACHE_LOG_DIR}/error.log" >> /etc/apache2/apache2.conf
RUN mkdir -p /var/log/apache2 && touch /var/log/apache2/error.log

RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli

