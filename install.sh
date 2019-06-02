#!/usr/bin/env bash
cp .env.example .env
composer install
php artisan key:generate
npm install
npm run dev
