# Use a imagem oficial do PHP com FPM
FROM php:8.2-fpm

# Instale dependências necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && apt-get clean

# Instale extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure o diretório de trabalho
WORKDIR /var/www

# Copie o conteúdo do projeto para dentro do container
COPY . .

# Instale as dependências do Laravel usando o Composer
RUN composer install

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]
