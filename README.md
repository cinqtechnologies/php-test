# PHP skills test

## Installing environment

First of all, it's necessary at least a webserver, a DBMS and php installed.
You can install postgresql + nginx + php, doing:

```
$ sudo apt install postgresql nginx php7.3 php7.3-fpm php7.3-pgsql
```

After that, you have to enabled PHP support on sites-available.
You can do that following skels/default file, that contains a default
nginx site configuration + PHP support.

## Setting up postgresql

First, it's necessary to create a user and a database for this user.

```
$ sudo su - postgres
$ psql
postgres=> CREATE USER cinq_st WITH PASSWORD '132456';
postgres=> CREATE DATABASE cinq_st;
postgres=> GRANT ALL PRIVILEGES ON DATABASE cinq_st TO cinq_st;
```

For testing purposes, let's disable peer authentication
$ sudo vim /etc/postgresql/11/main/pg_hba.conf

Change peer to md5 in "local"...
```
# "local" is for Unix domain socket connections only
local   all             all                                     peer
```

```
# "local" is for Unix domain socket connections only
local   all             all                                     md5
```

Restart postgresql
```
$ sudo service postgresql restart
```

From psql command-line, import skel.sql to start a demo instance:
```
$ psql -Ucinq_st -W
Password: [123456]
cinq_st=> \i skels/skel.sql
```

In order to facilitate, a populate.sql file is included to insert some values:
```
cinq_st=> \i skels/populate.sql
```

## Running

### Environment
This project was tested in the following environment:
- Debian Linux;
- PHP 7.3;
- Firefox (gecko) and Iridium (webkit) browsers;

### Let's do it

It is easy to run direct in your nginx instance, accessing http://localhost/
(in case this directory is the root folder).

**First, you need to setup your configuration on config.php file**

Otherwise, it is possible to use php builtin server, doing:
```
php -S localhost:8000 -d display_errors=1
```

and acessing http://localhost:8000.

## Upload and directory permissions
It is important to ensure directory ownership. You can do that with:
```
sudo chown -R www-data:www-data .
```

If you're using a webserver (apache/nginx), uploads directory (and its
subdirectory) just need 755 permissions.
Otherwise (builtin server) you will need give it 777 permission (don't do that
in production).

```
sudo chmod 755 uploads uploads/*/ # apache/nginx
```

```
sudo chmod 777 uploads uploads/*/ # php builtin server
```

## Directory structure and Ajax/JSON services
The project uses a simple MVC concept.

### Controller and ajax
There some ajax services for dynamic loading, but not all of them are used at
the moment. In the 'listing' pages, I chosen go for 'static loading'...

#### Controller
- insert_product.php - controller to insert product. Includes frm_insert_product from view;
- list_product.php - controller to list a specific product, allowing 'send e-mail'. Includes frm_list_product from view;
- list_products.php - controller to list all products, without details. Includes frm_list_products from view;
- insert_retailer.php - controller to insert retailer. Includes frm_insert_retailer from view;
- list_retailer.php - controller to list a specific retailers, with details. Includes frm_list_retailer from view;
- list_retailers.php - controller to list all retailers, without details. Includes frm_list_retailers from view.

#### Ajax/JSON

Being used;
- ajax_info_product.php - pretend to send e-mail (50% chance of success) with info about a specif product;
- ajax_insert_product.php - insert a product on database;
- ajax_insert_retailer.php - insert retailer on database;

Discarded (for the time being. They could be useful for dynamic loading/listing);
- ajax_list_product.php - list a specific product (returns JSON);
- ajax_list_products.php - list all products (returns JSON);
- ajax_list_retailer.php - list a specific retailer (returns JSON);
- ajax_list_retailers.php - list all retailers (returns JSON).

### Model
There are basically two classes for every entry (product, retailer).

- model/class/product.php
- model/class/retailer.php

Contain getters and setters for Product and Retailer classes.

- model/pgsql/productDAO.php
- model/pgsql/retailerDAO.php

Contain list/insert/move_to_object methods for ProductDAO and RetailerDAO classes.

### View

There are three forms for every entry (product, retailer):
- Insert: insert new entry;
- List all: list the entry;
- List specific entry with its details

## Final thoughts
There are two tables on databas (products and retailers) and two sequences.
However, in a real world situation, it would make more sense create a third
table (1->n), since two retailers can have the same product.
In order to facilitate the implementations of concepts to be evaluated, I
chosen to simplify the database design, but I'm aware of this specific case.
