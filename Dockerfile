# Dockerfile seguro para proyecto PHP (sanitiza llamadas a Telegram)
FROM php:8.2-apache

# Instalar utilidades necesarias
RUN apt-get update && \
    apt-get install -y --no-install-recommends findutils sed grep xargs && \
    rm -rf /var/lib/apt/lists/*

# Habilitar extensiones PHP comunes (ajusta según necesites)
RUN docker-php-ext-install mysqli pdo pdo_mysql || true

# Crear directorio de trabajo
WORKDIR /var/www/html

# Copiar el proyecto al contenedor
COPY . /var/www/html

# --------------------------
# Sanitización de seguridad
# --------------------------
# - Reemplaza valores asignados a BOT_TOKEN y CHAT_ID por "REDACTED_*"
# - Redacta tokens embebidos en URLs tipo api.telegram.org/bot<TOKEN>
# - Elimina líneas que contengan 'api.telegram.org' o 'sendMessage'
# NOTA: Esto modifica solo la copia dentro de la imagen, no los archivos en tu máquina.
RUN set -eux; \
    # Buscar archivos relevantes
    FILES="$(find /var/www/html -type f \( -name '*.html' -o -name '*.php' -o -name '*.js' \) -print)"; \
    if [ -n "$FILES" ]; then \
      echo "$FILES" | tr '\n' '\0' | xargs -0 -r sed -i -E \
        -e 's/((?:const|var|let)?\s*BOT_TOKEN\s*[:=]\s*)(["'\''])[A-Za-z0-9:_-]+(\2)/\1\2REDACTED_BOT_TOKEN\2/g' \
        -e 's/((?:const|var|let)?\s*CHAT_ID\s*[:=]\s*)(["'\''])[0-9]+(\2)/\1\2REDACTED_CHAT_ID\2/g' \
        -e 's#(api\.telegram\.org/bot)[A-Za-z0-9:_-]+#\1REDACTED#g' ; \
      # Eliminar líneas que hagan fetch/direct call a la API de telegram o sendMessage
      echo "$FILES" | tr '\n' '\0' | xargs -0 -r sed -i -E '/api\.telegram\.org/d;/sendMessage/d' ; \
    fi

# Dar permisos seguros
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Puerto
EXPOSE 80

# Arrancar Apache en primer plano
CMD ["apache2-foreground"]
