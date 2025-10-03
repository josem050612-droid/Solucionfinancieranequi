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

WORKDIR /var/www/html

# Copiar archivos ya sanitizados
COPY --from=builder /src/ /var/www/html/

# Permisos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
