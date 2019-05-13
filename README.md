# PHP skills test

## Instructions
Download or clone the repository to a folder where you can run a php virtual server version 7.

At the prompt or bash access the downloaded repository folder, and with php 7 running locally or by XAMPP, LAMP, WAMP or MAMP, start a local server by the command: php -S localhost: 8000

For the database we use Mysql version 5.7.24 with phpmyadmin, the database can be imported by the folder bancodedados in the repository. Adjust the connection in the Conexao.class.php file inside the Classes folder. The Database needs to be created in UTF8.

Access the system on the browser using the address localhost:8000 using the word admin for both login and password.

In the Shopping menu, you can check the list of products, the page with product details, the example page of the email sent to the customer, the Retail list and the retailer details page.

From the Content menu, you can manage retailer and product records.

In the Adminitrative menu, you can manage the logged in user's data, and the users who will have access to the system, as well as the system access permissions and logs.

To use the API, the following endpoints can be used in the browser address bar:
1) To list all products - localhost:8000/api/produto/listarTodos
2) To view the details of a single product - localhost:8000/api/produto/detalhesProduto/{ID}
3) To list all retailers - localhost:8000/api/varejista/listarTodos
4) To list all the details of a retailer and their products - localhost:8000/api/varejista/detalhesVarejista/{ID}

Ex.: localhost:8000/api/produto/detalhesProduto/1
	 localhost:8000/api/varejista/detalhesVarejista/1




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
