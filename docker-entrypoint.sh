#!/bin/bash
set -e
if [ ! -f "/var/www/html/vendor/autoload.php" ]; then
  echo "📦 Installing dependencies..."
  cd /var/www/html
  su -s /bin/bash -c "composer install --no-dev --optimize-autoloader --no-interaction" www-data
fi
exec apache2-foreground
EOF
chmod +x docker-entrypoint.sh