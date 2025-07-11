# Fix Permissions Script for St. Aloysius School Management System
# This script helps resolve the "view settings" permission issue during deployment

Write-Host "🔧 Fixing permission issues..." -ForegroundColor Green

# Clear all caches
Write-Host "🧹 Clearing caches..." -ForegroundColor Yellow
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan permission:cache-reset

# Run the settings permission fix
Write-Host "🔐 Fixing settings permission..." -ForegroundColor Yellow
php artisan fix:settings-permission

# Debug permissions to verify fix
Write-Host "🔍 Debugging permissions..." -ForegroundColor Yellow
php artisan debug:permissions

Write-Host "✅ Permission fix completed!" -ForegroundColor Green
Write-Host "🎉 If you still see errors, try running: php artisan deploy:setup" -ForegroundColor Cyan
