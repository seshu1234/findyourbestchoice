#!/bin/bash

echo "Creating Laravel storage directories..."
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/logs

echo "Setting permissions..."
chmod -R 775 storage

echo "Creating .gitkeep files..."
touch storage/framework/views/.gitkeep
touch storage/framework/cache/.gitkeep
touch storage/framework/sessions/.gitkeep
touch storage/logs/.gitkeep