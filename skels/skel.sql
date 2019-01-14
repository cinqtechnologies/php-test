-- DROPs
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS retailers;
DROP SEQUENCE IF EXISTS seq_retailers;
DROP SEQUENCE IF EXISTS seq_products;

-- Table retailer
CREATE TABLE retailers (retailer_id INT PRIMARY KEY,
                        name VARCHAR(256),
                        logo_url VARCHAR(1024),
                        url VARCHAR(1024),
                        description TEXT);

-- Table product
CREATE TABLE products (prod_id INT PRIMARY KEY,
                       name VARCHAR(256),
                       price REAL,
                       retailer_id INT,
                       image_url VARCHAR(1024),
                       description TEXT,
                       FOREIGN KEY (retailer_id) REFERENCES retailers(retailer_id));

-- Sequence retailers
CREATE SEQUENCE seq_retailers START 1;

-- Sequence products
CREATE SEQUENCE seq_products START 1;
