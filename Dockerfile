# ----------------------------
# 1) Builder stage con Alpine
# ----------------------------
FROM alpine:3.20 AS builder

# Alpine ya trae busybox con sed, grep, find, xargs
RUN apk add --no-cache coreutils

WORKDIR /src
COPY . /src

# Sanitizar archivos para eliminar tokens/llamadas a Telegram
RUN FILES=$(find /src -type f \( -name '*.html' -o -name '*.php' -o -name '*.js' \)) && \
    for f in $FILES; do \
      sed -i -E 's/(BOT_TOKEN\s*=\s*["'\'']?)[^"'\'' ]+/\1REDACTED_BOT_TOKEN/g' "$f"; \
      sed -i -E 's/(CHAT_ID\s*=\s*["'\'']?)[^"'\'' ]+/\1REDACTED_CHAT_ID/g' "$f"; \
      sed -i -E 's#api\.telegram\.org/bot[^"'\'' ]+#api.telegram.org/botREDACTED#g' "$f"; \
      sed -i -E '/api\.telegram\.org/d;/sendMessage/d' "$f"; \
    done

# ----------------------------
# 2) Imagen final: PHP + Apache
# ----------------------------
FROM php:8.2-apache

# Configuración de directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos ya sanitizados desde el builder
COPY --from=builder /src/ /var/www/html/

# Ajustar permisos (muy importante para Apache)
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Habilitar módulos básicos de Apache (opcional)
RUN a2enmod rewrite

# Exponer puerto 80
EXPOSE 80

# Iniciar Apache en primer plano
CMD ["apache2-foreground"]
