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

# Instale o Redis via PECL e habilite a extensão
RUN pecl install redis \
    && docker-php-ext-enable redis

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure o diretório de trabalho
WORKDIR /var/www

# Copie o conteúdo do projeto para dentro do container
COPY . .

# Instale as dependências do Laravel usando o Composer
RUN composer install

# Corrigir permissões para a pasta de armazenamento e cache do Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]
