## Instructions
- This project was made using Codeigniter framework, MySQL and PHP7
- Create database ecommerce_test
- Edit .env.development with database host,user and password (if necessary)
	-Example:
	DATABASE_HOST=127.0.0.1
	DATABASE_USER=root
	DATABASE_PASS=root
	DATABASE_NAME=ecommerce_test
- Start php built-in server at application root folder using: php -S 127.0.0.1:8080
- Create application tables accessing the following address at browser: http://127.0.0.1:8080/migrate
- Access application adress: http://127.0.0.1:8080/
- The following directories need write permission:
	- php-test/mock_email (Store email mock)
	- php-test/system/sessions (Store session files)

## API endpoints
- http://127.0.0.1:8080/products (list all products)
- http://127.0.0.1:8080/products/{product_id} (product details)
- http://127.0.0.1:8080/retailer/{retailer_id} (retailer details and products)
