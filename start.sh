#!/bin/sh
set -e

# Railway injects $PORT; fall back to 80 for local Docker runs
PORT="${PORT:-80}"

# Generate nginx config with the correct port at runtime
cat > /etc/nginx/http.d/default.conf <<EOF
server {
    listen ${PORT};
    root /var/www/html/public;
    index index.php;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
    }
}
EOF

# Run migrations
php artisan migrate --seed --force

# Start php-fpm in background and wait until it is ready
php-fpm -D
for i in $(seq 1 15); do
    nc -z 127.0.0.1 9000 2>/dev/null && break
    sleep 1
done

# Start nginx in foreground (keeps the container alive)
exec nginx -g 'daemon off;'
