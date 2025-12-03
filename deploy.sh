#!/bin/bash
echo "🚀 Starting Railway deployment setup..."

# Update .gitignore
echo "📝 Updating .gitignore..."
cat > .gitignore << 'EOF'
# Dependencies
/node_modules
/vendor

# Environment
.env
.env.*
.env.backup
.env.production

# Laravel
/public/build
/public/hot
/public/storage
/storage/*.key
/storage/pail
/storage/oauth-*.key
/storage/app/public
/storage/framework/cache/data
/storage/framework/testing
composer.lock

# Testing
.phpunit.result.cache
.phpunit.cache

# OS
.DS_Store
Thumbs.db

# IDE
/.idea
/.nova
/.vscode

# Local development files
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
auth.json
.phpactor.json

# Wave specific
/wave-pro
/wave/vendor/
/public/wave/docs
/storage/app/analytics
/packages
/resources/plugins/*
!/resources/plugins/installed.json
/storage/app/public/livewire-tmp
/public/uploads
/public/profile
/public/demo
/public/.well-known
storage/app/livewire-tmp
resources/themes/.gitignore

# Supabase
/supabase

# Node
npm-debug.log*
yarn-debug.log*
pnpm-debug.log*

# ========== EXCEPTIONS FOR RAILWAY ==========
# Allow these specific storage directories for Railway deployment
!storage/framework/views/.gitkeep
!storage/framework/cache/.gitkeep
!storage/framework/sessions/.gitkeep
!storage/logs/.gitkeep
EOF

echo "✅ .gitignore updated"

# Create storage directories
echo "📁 Creating storage directories..."
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/logs

# Create .gitkeep files
echo "📄 Creating .gitkeep files..."
echo "# Directory required for Laravel on Railway" > storage/framework/views/.gitkeep
echo "# Directory required for Laravel on Railway" > storage/framework/cache/.gitkeep
echo "# Directory required for Laravel on Railway" > storage/framework/sessions/.gitkeep
echo "# Directory required for Laravel on Railway" > storage/logs/.gitkeep

echo "✅ Storage directories created"

echo "🎉 Setup complete! Run the following commands:"
echo ""
echo "1. Clear git cache:"
echo "   git rm -r --cached storage/"
echo ""
echo "2. Force add storage files:"
echo "   git add -f storage/framework/views/.gitkeep"
echo "   git add -f storage/framework/cache/.gitkeep"
echo "   git add -f storage/framework/sessions/.gitkeep"
echo "   git add -f storage/logs/.gitkeep"
echo ""
echo "3. Add updated files:"
echo "   git add .gitignore composer.json"
echo ""
echo "4. Commit and push:"
echo "   git commit -m 'Fix Railway deployment'"
echo "   git push origin main"