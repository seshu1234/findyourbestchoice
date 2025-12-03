#!/bin/bash

# Create Laravel storage directories
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/logs

# Set permissions (adjust based on Railway's user)
chmod -R 775 storage

# Optional: Create cache files to ensure they exist
touch storage/framework/views/.gitkeep
touch storage/framework/cache/.gitkeep
touch storage/framework/sessions/.gitkeep
touch storage/logs/.gitkeep