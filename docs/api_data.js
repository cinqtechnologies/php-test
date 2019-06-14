define({ "api": [
  {
    "type": "post",
    "url": "/products",
    "title": "Create a product",
    "name": "CreateProduct",
    "group": "Product",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "retailerId",
            "description": "<p>Retailer unique ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Product name.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "price",
            "description": "<p>Product price.</p>"
          },
          {
            "group": "Success 200",
            "type": "File",
            "optional": false,
            "field": "logo",
            "description": "<p>Product image.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Product description.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": {\n         \"retailer_id\": 3,\n         \"name\": \"Duff Winter\",\n         \"price\": \"1.5\",\n         \"logo\": \"assets/images/products/1560401312.jpg\",\n         \"description\": \"A good choice for summer days.\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "src/Ecommerce/Http/Controllers/ProductController.php",
    "groupTitle": "Product"
  },
  {
    "type": "delete",
    "url": "/products/:id",
    "title": "Delete a product record",
    "name": "DeleteProduct",
    "group": "Product",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Product unique ID.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": {\n         \"id\": 8\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "src/Ecommerce/Http/Controllers/ProductController.php",
    "groupTitle": "Product"
  },
  {
    "type": "get",
    "url": "/products/:id",
    "title": "Show a product informaition",
    "name": "ShowProduct",
    "group": "Product",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Product unique ID.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": {\n         \"id\": 8,\n         \"retailer_id\": 3,\n         \"name\": \"Duff Summer\",\n         \"price\": 1.5,\n         \"logo\": \"assets/images/products/1560401312.jpg\",\n         \"description\": \"A good choice for summer days.\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "src/Ecommerce/Http/Controllers/ProductController.php",
    "groupTitle": "Product"
  },
  {
    "type": "get",
    "url": "/products",
    "title": "Show all products informaition",
    "name": "ShowProducts",
    "group": "Product",
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": [\n         {\n             \"id\": 8,\n             \"retailer_id\": 3,\n             \"name\": \"Duff Summer\",\n             \"price\": 1.5,\n             \"logo\": \"assets/images/products/1560401312.jpg\",\n             \"description\": \"A good choice for summer days.\"\n         },\n         {\n             \"id\": 9,\n             \"retailer_id\": 3,\n             \"name\": \"Duff Ice\",\n             \"price\": 1.65,\n             \"logo\": \"assets/images/products/65409871312.jpg\",\n             \"description\": \"Always a good choice.\"\n         },\n\n}",
          "type": "json"
        }
      ]
    },
    "filename": "src/Ecommerce/Http/Controllers/ProductController.php",
    "groupTitle": "Product"
  },
  {
    "type": "put",
    "url": "/products/:id",
    "title": "Update a product information",
    "name": "UpdateProduct",
    "group": "Product",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Product unique ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "retailerId",
            "description": "<p>Retailer unique ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Product name.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "price",
            "description": "<p>Product price.</p>"
          },
          {
            "group": "Success 200",
            "type": "File",
            "optional": false,
            "field": "logo",
            "description": "<p>Product image.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Product description.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": {\n         \"id\": 8,\n         \"retailer_id\": 3,\n         \"name\": \"Duff Summer\",\n         \"price\": 1.5,\n         \"description\": \"A good choice for summer days.\",\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "src/Ecommerce/Http/Controllers/ProductController.php",
    "groupTitle": "Product"
  },
  {
    "type": "post",
    "url": "/retailers",
    "title": "Create a retailer",
    "name": "CreateRetailer",
    "group": "Retailer",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Retailer name.</p>"
          },
          {
            "group": "Success 200",
            "type": "File",
            "optional": false,
            "field": "logo",
            "description": "<p>Retailer image.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Retailer description.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "website",
            "description": "<p>Retailer website.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": {\n         \"name\": \"Duff\",\n         \"logo\": \"assets/images/retailers/1560399890.jpg\",\n         \"description\": \"The best beer from Springfield\",\n         \"website\": \"https://www.duff.com\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "src/Ecommerce/Http/Controllers/RetailerController.php",
    "groupTitle": "Retailer"
  },
  {
    "type": "delete",
    "url": "/retailers/:id",
    "title": "Delete a retailer record",
    "name": "DeleteRetailer",
    "group": "Retailer",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Retailer unique ID.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": {\n         \"id\": 1\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "src/Ecommerce/Http/Controllers/RetailerController.php",
    "groupTitle": "Retailer"
  },
  {
    "type": "get",
    "url": "/retailers/:id",
    "title": "Show a retailer information",
    "name": "ShowRetailer",
    "group": "Retailer",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Retailer unique ID.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": {\n         \"id\": 1\n         \"name\": \"Duff\",\n         \"logo\": \"assets/images/retailers/1560399890.jpg\",\n         \"description\": \"The best beer from Springfield\",\n         \"website\": \"https://www.duff.com\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "src/Ecommerce/Http/Controllers/RetailerController.php",
    "groupTitle": "Retailer"
  },
  {
    "type": "get",
    "url": "/retailers/:id/products",
    "title": "Show all retailer products",
    "name": "ShowRetailerProducts",
    "group": "Retailer",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Retailer unique ID.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": [\n         {\n             \"id\": 1,\n             \"retailer_id\": 2,\n             \"name\": \"Wallet\",\n             \"price\": 2.99,\n             \"logo\": \"assets/images/products/1560466562.jpg\",\n             \"description\": \"Protect your money!\"\n         },\n         {\n             \"id\": 2,\n             \"retailer_id\": 2,\n             \"name\": \"Purse\",\n             \"price\": 29.99,\n             \"logo\": \"assets/images/products/1560466700.jpg\",\n             \"description\": \"Enjoy the best of life.\"\n         }\n     ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "src/Ecommerce/Http/Controllers/RetailerController.php",
    "groupTitle": "Retailer"
  },
  {
    "type": "get",
    "url": "/retailers",
    "title": "Show all retailer information",
    "name": "ShowRetailers",
    "group": "Retailer",
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": [\n         {\n             \"id\": 1\n             \"name\": \"Duff\",\n             \"logo\": \"assets/images/retailers/1560399890.jpg\",\n             \"description\": \"The best beer from Springfield\",\n             \"website\": \"https://www.duff.com\"\n         },\n         {\n             \"id\": 2\n             \"name\": \"Los Pollos Hermanos\",\n             \"logo\": \"assets/images/retailers/6327399993.jpg\",\n             \"description\": \"We deliver where you are\",\n             \"website\": \"https://www.lospolloshermanos.com\"\n         },\n     ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "src/Ecommerce/Http/Controllers/RetailerController.php",
    "groupTitle": "Retailer"
  },
  {
    "type": "put",
    "url": "/retailers/:id",
    "title": "Update a retailer information",
    "name": "UpdateRetailer",
    "group": "Retailer",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Retailer unique ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Retailer name.</p>"
          },
          {
            "group": "Success 200",
            "type": "File",
            "optional": false,
            "field": "logo",
            "description": "<p>Retailer image.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Retailer description.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "website",
            "description": "<p>Retailer website.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": {\n         \"name\": \"Duff\",\n         \"logo\": \"assets/images/retailers/1560399890.jpg\",\n         \"description\": \"The best beer from Springfield\",\n         \"website\": \"https://www.duff.com\"\n         \"id\": 1\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "src/Ecommerce/Http/Controllers/RetailerController.php",
    "groupTitle": "Retailer"
  }
] });
