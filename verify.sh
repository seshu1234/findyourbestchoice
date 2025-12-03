#!/bin/bash
echo "🔍 Verifying Railway setup..."

echo "1. Checking .gitignore exceptions..."
if grep -q "!storage/framework/views/.gitkeep" .gitignore && \
   grep -q "!storage/framework/cache/.gitkeep" .gitignore && \
   grep -q "!storage/framework/sessions/.gitkeep" .gitignore && \
   grep -q "!storage/logs/.gitkeep" .gitignore; then
    echo "✅ .gitignore has Railway exceptions"
else
    echo "❌ .gitignore missing exceptions"
    tail -10 .gitignore
fi

echo "2. Checking storage directories exist..."
if [ -d "storage/framework/views" ] && \
   [ -d "storage/framework/cache" ] && \
   [ -d "storage/framework/sessions" ] && \
   [ -d "storage/logs" ]; then
    echo "✅ Storage directories exist"
else
    echo "❌ Missing storage directories"
    ls -la storage/
fi

echo "3. Checking .gitkeep files..."
if [ -f "storage/framework/views/.gitkeep" ] && \
   [ -f "storage/framework/cache/.gitkeep" ] && \
   [ -f "storage/framework/sessions/.gitkeep" ] && \
   [ -f "storage/logs/.gitkeep" ]; then
    echo "✅ .gitkeep files exist"
else
    echo "❌ Missing .gitkeep files"
    find storage/ -name ".gitkeep" -type f
fi

echo "4. Checking composer.json..."
if grep -q "@php artisan package:discover" composer.json; then
    echo "✅ composer.json has package:discover"
else
    echo "❌ composer.json missing package:discover"
fi

echo ""
echo "📋 Next steps:"
echo "1. Run: git rm -r --cached storage/"
echo "2. Run: git add -f storage/framework/views/.gitkeep"
echo "3. Run: git add -f storage/framework/cache/.gitkeep"
echo "4. Run: git add -f storage/framework/sessions/.gitkeep"
echo "5. Run: git add -f storage/logs/.gitkeep"
echo "6. Run: git add .gitignore composer.json"
echo "7. Run: git commit -m 'Fix Railway deployment'"
echo "8. Run: git push origin main"