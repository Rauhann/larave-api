#!/bin/bash
set -eo pipefail

if [ ! -f ".env" ]
then
    echo "Error: .env not found."
    exit 1
fi

composer install && php artisan config:cache && php artisan view:clear
/usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf &
php-fpm

exit 0
