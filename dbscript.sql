--DROP DATABASE IF NOT EXISTS ecommerce_test
CREATE DATABASE IF NOT EXISTS ecommerce_test;
USE ecommerce_test;

CREATE TABLE IF NOT EXISTS ecommerce_test.products (
	id INT NOT NULL auto_increment,
	retailer_id INT NOT NULL,
	name VARCHAR(150) NOT NULL,
	image TEXT,
	price DECIMAL(12, 2) NOT NULL,
	description TEXT NOT NULL,
	creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
 );

CREATE TABLE IF NOT EXISTS ecommerce_test.retailer (
	id INT NOT NULL auto_increment,
	name VARCHAR(150) NOT NULL,
	logo TEXT,
	website VARCHAR(200) NOT NULL,
	description TEXT NOT NULL,
	creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);