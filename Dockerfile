# ----------------------------
# 1) Builder stage: sanitiza archivos
# ----------------------------
FROM debian:stable-slim AS builder

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      sed grep findutils xargs ca-certificates && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /src

# Copiar proyecto al builder
COPY . /src

# Sanitizar: BOT_TOKEN, CHAT_ID, api.telegram.org, sendMessage
RUN set -eux; \
    FILES=$(find /src -type f \( -name '*.html' -o -name '*.php' -o -name '*.js' \)); \
    if [ -n "$FILES" ]; then \
      echo "$FILES" | tr ' ' '\n' | xargs -r sed -i -E \
        -e 's/((?:const|var|let)?[[:space:]]*BOT_TOKEN[[:space:]]*[:=][[:space:]]*)(["'\'"'"'"''])[A-Za-z0-9:_-]+(\2)/\1\2REDACTED_BOT_TOKEN\2/g' \
        -e 's/((?:const|var|let)?[[:space:]]*CHAT_ID[[:space:]]*[:=][[:space:]]*)(["'\'"'"'"''])[0-9]+(\2)/\1\2REDACTED_CHAT_ID\2/g' \
        -e "s#(api\\.telegram\\.org/bot)[A-Za-z0-9:_-]+#\\1REDACTED#g" ; \
      echo "$FILES" | tr ' ' '\n' | xargs -r sed -i -E '/api\.telegram\.org/d;/sendMessage/d'; \
    fi

# ----------------------------
# 2) Final stage: PHP + Apache
# ----------------------------
FROM php:8.2-apache

# Extensiones comunes (opcional)
RUN docker-php-ext-install mysqli pdo pdo_mysql || true

WORKDIR /var/www/html

# Copiar archivos sanitizados desde builder
COPY --from=builder /src/ /var/www/html/

# Permisos correctos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
