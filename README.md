# CINQ Developer Test
<p align="center"><img src="https://github.com/LuizNicolat/php-test/blob/luiz-nicolat/cinqLogo.png?raw=true"></p>

Complete CRUD for CINQ's developer test, containing basic usage for Product and Retailer, including all the API endpoints.

# Follow the steps ahead to use the application

  - Access https://github.com/LuizNicolat/php-test, then clone or download the project
  - If you've downloaded the project, extract it to your server specific folder, or if you are developing locally, extract it to the web folder of the server. Example: Laragon -> 'www' folder on laragon's root dir.
  - Create a database named 'mvctest', and set the database user = 'root' and password = '123456'
  - Open app folder, then make a copy of the 'env.example' file, then rename it to '.env'
  - Open the .env file, and set the following parameters: DB_DATABASE=MVCtest, DB_USERNAME=root, DB_PASSWORD=123456
  - Still in the app folder, open the terminal and hit the following command: composer dumpautoload, wait to finish
  - Still in the terimanl, hit the following command: php artisan key:generate, wait to finish
  - Still in the terimanl, hit the following command: php artisan migrate, wait to finish
  - The application must be running now.
  - If it doesn't, you have to check the .htaccess file in your server.

### List of API endpoints

Product API Endpoints

GET    - /api/product' - Return JSON list with all products

POST   - /api/product' - Store a new product via POST method

GET    - /api/productdetail/{idproduto}' - return prodct details passing id via GET

PUT    - /api/product/{product}', - Update a product, passing a JSON object.

DELETE - /api/product/{product}' - Delete a product by passing the ID.

Retailer API Endpoints

GET    - /api/retailer' - Return JSON list with all retailers

POST   - /api/retailer' - Store a new retailer via POST method

GET    - /api/retailerDetail/{idproduto}' - return retailer details passing id via GET

PUT    - /api/retailer/{retailer}', - Update a retailer, passing a JSON object.

DELETE - /api/retailer/{retailer}' - Delete a retailer, by using it's ID.

### Plugins

The followig plugins were used to develop this application's models.

| Plugin | README |
| ------ | ------ |
| Eloquent Model Generator | https://github.com/krlove/eloquent-model-generator |

#### Framework
The whole application was developed using the laravel framework, version 5.8.

