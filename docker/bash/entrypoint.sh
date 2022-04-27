#!/bin/bash
set -eo pipefail

sleep 5s

if [ ! -f ".env" ]
then
    echo "Error: .env not found."
    exit 1
fi

su -c "composer install" -s /bin/sh nginx
su -c "php artisan config:cache" -s /bin/sh nginx
su -c "php artisan horizon:publish" -s /bin/sh nginx
su -c "php artisan l5-swagger:generate" -s /bin/sh nginx
su -c "php artisan migrate" -s /bin/sh nginx
/usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf &
cron
php-fpm

exit 0
