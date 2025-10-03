# Dockerfile seguro para proyecto PHP + Apache
FROM php:8.2-apache

# Instalar utilidades necesarias
RUN apt-get update && \
    apt-get install -y --no-install-recommends git unzip findutils sed grep && \
    rm -rf /var/lib/apt/lists/*

# Habilitar extensiones PHP comunes (ajusta según necesites)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar el proyecto al contenedor
COPY . /var/www/html/

# Redactar tokens/credenciales de Telegram u otros patrones peligrosos durante la build.
# - Reemplaza valores asignados a BOT_TOKEN y CHAT_ID en scripts.
# - Reemplaza cualquier uso directo en URLs tipo https://api.telegram.org/bot<TOKEN>
# NOTA: Esto modifica los archivos copiados dentro de la imagen; los archivos del host no cambian.
RUN set -eux; \
    # 1) Redactar asignaciones tipo: const BOT_TOKEN = "...."; const CHAT_ID = "....";
    find /var/www/html -type f \( -name '*.html' -o -name '*.php' -o -name '*.js' \) -print0 \
      | xargs -0 -r sed -i \
        -e 's/\(BOT_TOKEN\s*=\s*\)"[^"]*"/\1"REDACTED_BOT_TOKEN"/g' \
        -e "s/\(BOT_TOKEN\\s*=\\s*'[^']*'\\)/\\1'REDACTED_BOT_TOKEN'/g" \
        -e 's/\(CHAT_ID\s*=\s*\)"[^"]*"/\1"REDACTED_CHAT_ID"/g' \
        -e "s/\(CHAT_ID\\s*=\\s*'[^']*'\\)/\\1'REDACTED_CHAT_ID'/g" || true; \
    # 2) Redactar tokens embebidos en URLs tipo api.telegram.org/bot<TOKEN>
    find /var/www/html -type f \( -name '*.html' -o -name '*.php' -o -name '*.js' \) -print0 \
      | xargs -0 -r sed -i -E 's#(api\.telegram\.org/bot)[A-Za-z0-9:_-]+#\1REDACTED#g' || true; \
    # 3) Como medida extra, eliminar líneas que llamen explícitamente a api.telegram.org/sendMessage (opcionalmente conservando contexto)
    find /var/www/html -type f \( -name '*.html' -o -name '*.php' -o -name '*.js' \) -print0 \
      | xargs -0 -r awk 'BEGIN{IGNORECASE=1} { if ($0 ~ /api\\.telegram\\.org.*sendMessage/) next; print }' > /tmp/_awk_out && mv /tmp/_awk_out /tmp/_awk_backup || true

# Ajustar propietarios y permisos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Exponer el puerto web
EXPOSE 80

# Comando por defecto (Apache en primer plano)
CMD ["apache2-foreground"]
