FROM php:8.2-apache

# Instalar extensiones de base de datos que pide PHP para conectarse con MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar todos tus archivos .php locales al servidor de Render
COPY . /var/www/html/

# Habilitar el puerto estándar de internet
EXPOSE 80