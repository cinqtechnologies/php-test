# CINQ Backend PHP Test

## API Doc

You can find the API documentation at [diogocavilha.github.io/php-test](https://diogocavilha.github.io/php-test/)

## Setting Up The Project
```bash
git clone https://github.com/diogocavilha/php-test.git phptest -b diogocavilha
cd phptest/

# The whole project was built over a docker environment.
# So we need to create the docker image by running the following command.
docker build . -t tuxmate/php:testing

# After that, we can run the following command to configure all we need to start using the project.
make configure

# That command will populate the database with predefined data in order to test the API. 
# It populates the database by using a PHP dependency called Phinx.
```

## Runing The Unit Tests
```bash
cd phptest/
make test
```

> A few tests are failing, unfortunately the challenge time is running out :(

> In order to check all the available commands you can run the command `make help`.

## Available Ports

Porta  | Aplicação
------ | -----------------
8081   | API
8080   | Front-end
9092   | PHPMyAdmin

## Database Access

Usuário | Senha
------- | ----------
root    | admin

## Screenshots

### Retailer List
![Retailer List](https://github.com/diogocavilha/php-test/blob/diogocavilha/public/assets/screenshots/retailer-list.png)

### Retailer Entry
![Retailer Entry](https://github.com/diogocavilha/php-test/blob/diogocavilha/public/assets/screenshots/retailer-entry.png)

### Retailer Details and Products
![Retailer Details and Products](https://github.com/diogocavilha/php-test/blob/diogocavilha/public/assets/screenshots/retailer-details-and-products.png)

### Product Entry
![Product Entry](https://github.com/diogocavilha/php-test/blob/diogocavilha/public/assets/screenshots/product-entry.png)

### Product Details
![Product Details](https://github.com/diogocavilha/php-test/blob/diogocavilha/public/assets/screenshots/product-details.png)
