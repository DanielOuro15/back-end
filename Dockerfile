# Use uma imagem PHP com suporte a Composer e extensões necessárias
FROM php:8.1-fpm

# Instala extensões e dependências necessárias
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto para o container
COPY . .

# Instala as dependências do Laravel
RUN composer install --optimize-autoloader --no-dev

# Define permissões para a pasta de cache e armazenamento
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Expõe a porta do servidor Laravel
EXPOSE 8000

# Define o comando de inicialização
CMD php artisan serve --host=0.0.0.0 --port=8000
