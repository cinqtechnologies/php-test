# Overview
This solution is composed of three service layers:
- Back-end RESTful API built in PHP 7.2 with Lumen
- Front-end Javascript application built with Javascript/Angular 7
- External MySQL 5.7 database

## Contact Info

### Marco Antonio da Silva Moura ###
- marco.moura@fatec.sp.gov.br
- +55 41 998 168 126
- http://linkedin.com/in/mouram

## Infrastructure
The application is set to work within a docker cluster, whereas each service is inside their own container, except for the database. The cluster is bootstrapped with Docker-Compose.

## Requirements
- Docker
- Docker-compose (supporting file version 3.0 or higher)
- MySQL 5.7 database

## Instructions
- Clone this repository
- Copy the .env.example file located in the api folder, renaming it to .env
- Due to several issues I found while trying to reference a MySQL container within my cluster, which are potentially related to my Docker runtime installation, I've taken the decision to create a development instance on Amazon RDS instead. For your convenience, I'm disclosing its credentials below, which I wouldn't, naturally, do in a real-case scenario.
    - Address: ecommerce.cnc0cefnqksq.sa-east-1.rds.amazonaws.com
    - Username: root
    - Password: Coca-Cola1
    - Port: 3306
    - Default Schema: ecommerce
- Fill in the following variables of the .env file with the database name, address, username and password:
    - DB_HOST=your-database-address
    - DB_PORT=database-port
    - DB_DATABASE=database-name
    - DB_USERNAME=database-username
    - DB_PASSWORD=database-password 

- There is no need to import a database schema. This is automatically handled by the migration script, which is run upon container creation.
- Finally, being at the root of the repository directory, where the docker-compose.yml file is located, run the following command in your bash: 
```
docker-compose up -d --build 
```
That should compile both the back-end and front-end applications, generate the database schema, and serve the applications. **Please note that this will NOT produce data seeds (fake data)**.

## API Reference
The REST API base URL is **http://localhost:9000/api/v1**

### Retailers
List all available retailers
```
GET /retailers

Returns:

200(OK)
[
    {
        "id": 1,
        "name": "Walmart",
        "logo": null,
        "description": "Walmart Stores",
        "website": "www.walmart.com",
        "created_at": "2019-05-15 17:24:39",
        "updated_at": "2019-05-15 17:24:39"
    },
    {
        "id": 2,
        "name": "Pepsi",
        "logo": null,
        "description": "Pepsi Company",
        "website": "www.pepsi.com",
        "created_at": "2019-05-15 17:35:53",
        "updated_at": "2019-05-15 17:35:53"
    }
]
```

View details of a retailer by ID
```
GET /retailers/{id}

Returns:

200(OK)
{
    "id": 1,
    "name": "Walmart",
    "logo": null,
    "description": "Walmart Stores",
    "website": "www.walmart.com",
    "created_at": "2019-05-15 17:24:39",
    "updated_at": "2019-05-15 17:24:39",
    "products": [
        {
            "id": 1,
            "name": "Walmart",
            "price": 12.95,
            "image": null,
            "retailerId": 1,
            "description": "Walmart Stores",
            "created_at": "2019-05-15 17:28:02",
            "updated_at": "2019-05-15 17:28:02"
        },
        {
            "id": 2,
            "name": "Smartphone",
            "price": 99.5,
            "image": null,
            "retailerId": 1,
            "description": "LG Smartphone",
            "created_at": "2019-05-15 17:30:39",
            "updated_at": "2019-05-15 17:30:39"
        }
    ]
}
```

Create a new retailer
```
POST /retailers
{
	"name": "Walmart",
	"description": "Walmart Stores",
	"website": "www.walmart.com"
}

Returns:

200(OK)
{
    "name": "Walmart",
    "description": "Walmart Stores",
    "website": "www.walmart.com",
    "updated_at": "2019-05-15 17:24:39",
    "created_at": "2019-05-15 17:24:39",
    "id": 1
}
```

### Products

List all available products
```
GET /products
GET /products?retailerId={id} [optional parameter]

Returns:

200(OK)
[
    {
        "id": 1,
        "name": "Walmart",
        "price": 12.95,
        "image": null,
        "retailerId": 1,
        "description": "Walmart Stores",
        "created_at": "2019-05-15 17:28:02",
        "updated_at": "2019-05-15 17:28:02",
        "retailer": {
            "id": 1,
            "name": "Walmart",
            "logo": null,
            "description": "Walmart Stores",
            "website": "www.walmart.com",
            "created_at": "2019-05-15 17:24:39",
            "updated_at": "2019-05-15 17:24:39"
        }
    },
    {
        "id": 2,
        "name": "Smartphone",
        "price": 99.5,
        "image": null,
        "retailerId": 1,
        "description": "LG Smartphone",
        "created_at": "2019-05-15 17:30:39",
        "updated_at": "2019-05-15 17:30:39",
        "retailer": {
            "id": 1,
            "name": "Walmart",
            "logo": null,
            "description": "Walmart Stores",
            "website": "www.walmart.com",
            "created_at": "2019-05-15 17:24:39",
            "updated_at": "2019-05-15 17:24:39"
        }
    }
]
```

View details of a product by ID
```
GET /products/{id}

Returns:

200(OK)
{
    "id": 2,
    "name": "Smartphone",
    "price": 99.5,
    "image": null,
    "retailerId": 1,
    "description": "LG Smartphone",
    "created_at": "2019-05-15 17:30:39",
    "updated_at": "2019-05-15 17:30:39",
    "retailer": {
        "id": 1,
        "name": "Walmart",
        "logo": null,
        "description": "Walmart Stores",
        "website": "www.walmart.com",
        "created_at": "2019-05-15 17:24:39",
        "updated_at": "2019-05-15 17:24:39"
    }
}
```

Create a new product
```
POST /products
{
	"name": "Smartphone",
	"description": "LG Smartphone",
	"retailerId": 1,
	"price": 99.50
}

Returns:

200(OK)
{
    "name": "Smartphone",
    "price": 99.5,
    "retailerId": 1,
    "description": "LG Smartphone",
    "updated_at": "2019-05-15 17:30:39",
    "created_at": "2019-05-15 17:30:39",
    "id": 2
}
```

## Front-End Reference

The base URL is: **http://localhost:3000**

#### Retailers

List all
```
There is no retailer List page. They are only listed at the dropdown available in the "Add Product" form.
```

Create a new retailer
```
/retailers/add
```

View a retailer
```
/retailers/{id}
```

### Products

List all
```
/products
```

or simply
```
/
```

Create a new product
```
/products/add
```

View a product
```
/products/{id}
```
