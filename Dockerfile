FROM php:8.2.31-apache

COPY src/ /var/www/html/

COPY src/form.php /var/www/html/

COPY src/confirm.php /var/www/html/

COPY src/index.php /var/www/html/
