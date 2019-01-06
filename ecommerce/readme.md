## Instructions

- clone the repository
- in the ecommerce folder, edit the .env file:
- DB_DATABASE=ecommerce
- DB_USERNAME=yourusername
- DB_PASSWORD=yourpassword
- MAIL_DRIVER=log
- then, run the following commands:
- composer install
- npm install
- php artisan migrate
- composer dump-autoload
- php artisan db:seed
- php artisan storage:link
- php artisan serve
- access the application: http://127.0.0.1:8000

The email mock will the stored at storage/logs folder

## API

List all products in chunks of 6 items
- http://127.0.0.1:8000/products?page={page}

List all the retailer's products in chunks of 6 items
- http://127.0.0.1:8000/products/{retailer_id}?page={page}

Fetch the product details
- http://127.0.0.1:8000/product/{product_id}