# Permisos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copiar el script de arranque y darle permisos de ejecución dentro de Linux
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Indicar a Docker que use el script como punto de entrada
ENTRYPOINT ["entrypoint.sh"]