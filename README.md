# Overview
This solution is composed of three service layers:
- Back-end RESTful API built in PHP 7.2 with Lumen
- Front-end Javascript application build with Angular 7
- External MySQL 5.7 database

## Infrastructure
The application is set to work within a docker cluster, whereas each service is inside their own container, except for the database. The cluster is bootstrapped with Docker-Compose tool.

## Requirements
- Docker
- Docker-compose (supporting file version 3.0^)
- MySQL 5.7 database

## Instructions
- Clone this repository
- Copy the .env.example file located in the api folder, renaming it to .env
- Fill in the following variables with your database name, address, username and password:
-- DB_HOST=
-- DB_PORT=
-- DB_DATABASE=
-- DB_USERNAME=
-- DB_PASSWORD=
