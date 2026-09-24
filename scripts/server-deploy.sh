#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
CMS="$ROOT/allomate-WebNCMS"

echo "Deploying DottScale from $ROOT"

if [[ ! -d "$CMS" ]]; then
  echo "allomate-WebNCMS is missing. Commit the CMS into this repo first."
  exit 1
fi

cd "$CMS"

composer install --no-dev --optimize-autoloader --no-interaction

php artisan migrate --force
php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

cd "$ROOT"
if command -v npm >/dev/null 2>&1 && [[ -f package.json ]]; then
  npm ci --omit=dev
  npm run build:css
fi

echo "Deploy finished."
