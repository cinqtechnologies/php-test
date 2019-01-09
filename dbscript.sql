--DROP DATABASE IF NOT EXISTS ecommerce_test
CREATE DATABASE IF NOT EXISTS ecommerce_test;
USE ecommerce_test;

CREATE TABLE IF NOT EXISTS products (
	id INT NOT NULL auto_increment,
	retailer_id INT NOT NULL,
	name VARCHAR(150) NOT NULL,
	image TEXT,
	price DECIMAL(12, 2) NOT NULL,
	description TEXT NOT NULL,
	creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
 );

CREATE TABLE IF NOT EXISTS retailer (
	id INT NOT NULL auto_increment,
	name VARCHAR(150) NOT NULL,
	logo TEXT,
	website VARCHAR(200) NOT NULL,
	description TEXT NOT NULL,
	creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
 );

/*
SELECT 
	r.id,
	r.name,
	r.description,
	r.website
FROM 
	retailer AS r
*/

/*
SELECT 
	p.id,
	p.name AS product_name,
	p.retailer_id,
	p.image,
	r.name AS retailer_name,
	p.description
FROM
	products AS p
INNER JOIN
	retailer AS r
ON p.retailer_id = r.id

-- WHERE p.retailer_id = :retailer_id
-- WHERE p.id = :product_id
*/

--INSERT INTO retailer (name, logo, website, description) VALUES ('TEST retailer', 'logo.png', 'www.website.com', 'RETAILER DESCRIPTION');
--INSERT INTO products (retailer_id, name, image, price, description) VALUES (1,'TEST product', 'img.png', 100.01, 'PRODUCT DESCRIPTION');