# Berfore start

The following software must be installed:
- Composer
- Laravel
- Node.js
- NPM
- MySQL
- PHP MySQL extension

# How to install

To install just run install.sh file in root directory, this script will: 
- Create .env file
- Generate the key for Laravel
- Run composer install
- Install cross-env
- Run npm install and generates CSS e JavaScript files

Now is necessary create a database in MySQL and set this information in .env file, change the following variables in .env:
- DB_DATABASE=[database name you just created]
- DB_USERNAME=[user to this database]
- DB_PASSWORD=[password to connect to database]

After this is just to run the command "php artisan migrate:fresh" and all the tables will be created. 
If you want you can also run "php artisan db:seed" to seed database.

# Run
To run just execute "php artisan serve"

# URL's
- /products
- /product/{id}
- /product-new
- /product-edit/{id}
- /retailers
- /retailer/{id}
- /retailer-new
- /retailer-edit/{id}

All URL's can be found in "/routes/web.php".

# API end-points
- /api/v1/product/new
- /api/v1/product/{id}/edit
- /api/v1/product/{id}
- /api/v1/products
- /api/v1/retailer/new
- /api/v1/retailer/{id}/edit
- /api/v1/retailer/{id}
- /api/v1/retailer/{id}/products
- /api/v1/retailers

All API end-points can be found in "/routes/api.php".
