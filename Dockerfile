# --- Etapa 1: Build de Assets (Node) ---
FROM node:22-alpine AS frontend-builder
WORKDIR /app
COPY . .
RUN npm ci && npm run build

# --- Etapa 2: Servidor Laravel (PHP) ---
FROM php:8.4-fpm-alpine

# Instalar dependencias del sistema y extensiones PHP
RUN apk add --no-cache \
    nginx \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    sqlite-dev

RUN docker-php-ext-install pdo_sqlite pdo_mysql bcmath gd zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .
COPY --from=frontend-builder /app/public/build ./public/build

# Instalar dependencias de PHP
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar netcat para el healthcheck de php-fpm en start.sh
RUN apk add --no-cache netcat-openbsd

# Copiar y preparar el script de arranque
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Railway asigna el puerto via $PORT; lo exponemos como referencia
EXPOSE 80

CMD ["/start.sh"]