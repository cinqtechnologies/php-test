# PHP skills test

## Objective
The aim of this test is to evaluate the applicant skills on:
- Basic backend concepts;
- Database queries;
- Data manipulation and treatment;
- MVC concept for a back + front end application
- API building concepts
- Code structure and organization

---

## How to start and send us the test
- Fork this repository
- Create a branch with your name-surname as its name (e.i. john-doe)
- Develop the test
- Create a pull request to this repo on the master branch with your code.

---

## Basic Guidelines
For this test you are developing a small e-commerce app. The app must have just a list of products. The products must display the following:

- Name
- Price
- One Image
- Retailer name
- Description

Also, the user must be able to click on any retailer name, and filter the product list to show only the selected retailer's products alongside with the retailer's details. The retailer must have the following details:
- Name
- Logo (image)
- Description
- Website

---

## Additional Guidelines

The main ideia of this test is to understand how your logical thinkin works when deciding how to implement some generic requirements. Considering that, you may:
- Use any framework you feel confortable with;
- Use any database you feel confortable with;

Keep in mind that we may contact you to ask you some question about your test, regarding how and why you took a given decision when developing the app for this test.

---

## Basic Requirements
The final app must have:
- A product list view;
- A single product view
  - An e-mail input where user can insert his/her e-mail to get a given product details sent to his/her e-mail (the e-mail may not be actually sent, but it must be generated have the delivery simulated/mocked);
- A retailer view
  - Retailer's products and details
- A Product create view
- A Retailer create view
- API endpoints that return JSONs for:
  - Product list
  - Product details
  - Retailer details and products

---

## Additional Requirements
When you finish the test app, you must:
- Provide a README.md with:
  - Instructions how to make your app work with a database (schema name, ENV variables to set, username and password, etc.);
  - The API endpoints and the application URL for the server-side rendered views;
- Code a build command that will build your code and prepare a mock server to test it.
- Push your code to a github repository and give [cinqtechnologies](https://github.com/cinqtechnologies/) access to it;

---

## Pluses
- Unit tests


## Para rodar a aplicação

Requisitos (Laravel 5.8)

    - PHP >= 7.1.3
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Mbstring PHP Extension
    - Tokenizer PHP Extension
    - XML PHP Extension
    - Ctype PHP Extension
    - JSON PHP Extension
    - BCMath PHP Extension

Copie a pasta cinq para o servidor
Abra o arquivo .env (cinq/.env) e coloque os dados do seu banco de dados.
(no env que eu subi eu coloquei de maneira simples, banco de dados, usuario e senha iguais; *cinq*)

Rode as migrations
 	
~~~~
php artisan migrate
~~~~

Rode as seeds

~~~~
php artisan db:seed
~~~~

Use

Anexos:

API Endpoints

- /api/products (Listar produtos)
- /api/products/{id} (Exibir informações de um produto específico)
- /api/retailer (Listar retailers)
- /api/retailer/{id} (Exibir informações de um retailer específico)
