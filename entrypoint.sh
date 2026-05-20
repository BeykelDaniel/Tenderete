#!/bin/sh

# Salir inmediatamente si algún comando falla
set -e

# Caché de configuración de Laravel
php artisan config:cache

# Crear el enlace simbólico del storage
php artisan storage:link

# Arrancar Apache en primer plano (el proceso principal)
exec apache2-foreground