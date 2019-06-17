# PHP Simple E-commerce Api

## Objective
Simple Api developed in PHP Slim Framework. 

## Postman Collection
In the postman we have interactive examples
[Postman Collection Api](https://www.getpostman.com/collections/111dc85bdea3844d61ad)

## Basic Guidelines
### Database
MySQL database used to this project
```sql
-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.24 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.1.0.5464
-- --------------------------------------------------------

-- Create E-Commerce Database
CREATE DATABASE IF NOT EXISTS `ecommerce` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ecommerce`;

-- Create Products table
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `retailer_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(63) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `image` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_products_retailers` (`retailer_id`),
  CONSTRAINT `FK_products_retailers` FOREIGN KEY (`retailer_id`) REFERENCES `retailers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create Retailers table
CREATE TABLE IF NOT EXISTS `retailers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` text NOT NULL,
  `description` text NOT NULL,
  `website` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

### Environment
#### Required tools
* LAMP or WAMP
* PHP 7.2 or upper
* Composer
* Postman

Clone the project into the valid `LAMP` directory and run `composer install` command.
After this the project will be accessible in `localhost/php-test/api/public`.

#### Endpoints
The Header content type needs be `application/json`
The available endpoints are:
##### Products
###### GET /api/public/product/{OPTIONAL id}
Get all products, with an optional valid Id to get only one.

###### POST /api/public/product
Create a new product. 
###### Body Requirements
* name: String. REQUIRED
* price: Float. REQUIRED
* retailer_id: Integer. REQUIRED
* description: String. Required
* image: Base64 String. REQUIRED

###### PATCH /api/public/product
Update an existing product. 
###### Body Requirements:
* id: Integer. REQUIRED,
* name: String. REQUIRED,
* price: Float. REQUIRED,
* retailer_id: Integer. REQUIRED,
* description: Description. REQUIRED,
* image": Base64 String. REQUIRED

###### DELETE /api/public/product/{REQUIRED id}
Exclude the product, with a required valid id

##### Retailers
###### GET /api/public/retailer/{OPTIONAL id}
Get all retailers, with an optional valid Id to get only one.

###### POST /api/public/retailer
Create a new retailer. 
###### Body Requirements
* description: String. REQUIRED
* website: String. Required
* logo: Base64 String. REQUIRED

###### PATCH /api/public/retailer
Update an existing retailer. 
###### Body Requirements:
* id: Integer. REQUIRED,
* description: String. REQUIRED
* website: String. Required
* logo: Base64 String. REQUIRED

###### DELETE /api/public/retailer/{REQUIRED id}
Exclude the retailer, with a required valid id
