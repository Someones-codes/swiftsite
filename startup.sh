#!/bin/bash

# Point Nginx to Laravel's public folder
echo "server {
    listen 8080;
    listen [::]:8080;
    root /home/site/wwwroot/public;
    index index.php index.html;
    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }
    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        include fastcgi_params;
    }
}" > /etc/nginx/sites-available/default

# Run Laravel setup
cd /home/site/wwwroot
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link

# Restart nginx
service nginx reload