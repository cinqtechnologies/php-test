-- It is necessary to run the skel.sql script before to populate the database.

-- Inserting retailers
INSERT INTO retailers (retailer_id, name, logo_url, url, description)
VALUES (nextval('seq_retailers'), 'João da Silva', 'joao.jpg', 'https://www.joao.com.br', 'João da Silva description.');

INSERT INTO retailers (retailer_id, name, logo_url, url, description)
VALUES (nextval('seq_retailers'), 'José da Silva', 'jose.jpg', 'https://www.jose.com.br', 'José da Silva description.');

INSERT INTO retailers (retailer_id, name, logo_url, url, description)
VALUES (nextval('seq_retailers'), 'Maria da Silva', 'maria.jpg', 'https://www.maria.com.br', 'Maria da Silva description.');

-- Inserting products
INSERT INTO products (prod_id, name, price, retailer_id, image_url, description)
VALUES (nextval('seq_products'), 'Bubbaloo do João', 1.5, 1, 'bubbaloo.jpg', 'Bubbaloo do João description.');

INSERT INTO products (prod_id, name, price, retailer_id, image_url, description)
VALUES (nextval('seq_products'), 'M&M do João', 1.6, 1, 'mm.jpg', 'M&M do João description.');

INSERT INTO products (prod_id, name, price, retailer_id, image_url, description)
VALUES (nextval('seq_products'), 'Kit Kat do João', 1.7, 1, 'kitkat.jpg', 'Kit Kat do João description.');

INSERT INTO products (prod_id, name, price, retailer_id, image_url, description)
VALUES (nextval('seq_products'), 'Bubbaloo do José', 2.5, 2, 'bubbaloo.jpg', 'Bubbaloo do Jose description.');

INSERT INTO products (prod_id, name, price, retailer_id, image_url, description)
VALUES (nextval('seq_products'), 'M&M do José', 2.6, 2, 'mm.jpg', 'M&M do Jose description.');

INSERT INTO products (prod_id, name, price, retailer_id, image_url, description)
VALUES (nextval('seq_products'), 'Kit Kat do José', 2.7, 2, 'kitkat.jpg', 'Kit Kat do Jose description.');

INSERT INTO products (prod_id, name, price, retailer_id, image_url, description)
VALUES (nextval('seq_products'), 'Bubbaloo da Maria', 3.5, 3, 'bubbaloo.jpg', 'Bubbaloo da Maria description.');

INSERT INTO products (prod_id, name, price, retailer_id, image_url, description)
VALUES (nextval('seq_products'), 'M&M da Maria', 3.6, 3, 'mm.jpg', 'M&M da Maria description.');

INSERT INTO products (prod_id, name, price, retailer_id, image_url, description)
VALUES (nextval('seq_products'), 'Kit Kat da Maria', 3.7, 3, 'kitkat.jpg', 'KitKat da Maria description.');

