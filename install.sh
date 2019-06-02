#!/usr/bin/env bash
cp .env.example .env
php artisan key:generate
composer install
npm install --global cross-env
npm install
npm run dev
