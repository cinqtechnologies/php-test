<?php

declare(strict_types=1);

namespace Ecommerce\Http\Controllers;

use Ecommerce\Exceptions\NotFoundException;
use Ecommerce\Http\Controllers\ApiController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class ProductController extends ApiController
{
    /**
     * @api {post} /products Create a product
     * @apiName CreateProduct
     * @apiGroup Product
     * @apiVersion 1.0.0
     *
     * @apiSuccess {Number} retailerId Retailer unique ID.
     * @apiSuccess {String} name Product name.
     * @apiSuccess {Number} price Product price.
     * @apiSuccess {File} logo Product image.
     * @apiSuccess {String} description Product description.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": {
     *              "retailer_id": 3,
     *              "name": "Duff Winter",
     *              "price": "1.5",
     *              "logo": "assets/images/products/1560401312.jpg",
     *              "description": "A good choice for summer days."
     *          }
     *     }
     */
    public function create(Request $request, Response $response): Response
    {
        $retailerId = (int) $request->getParam('retailerId');
        $name = $request->getParam('name');
        $price = (float) $request->getParam('price');
        $description = $request->getParam('description');
        $logo = $request->getUploadedFiles();

        $productBusiness = $this->di->get('productBusiness');
        $product = $productBusiness->add(
            $retailerId,
            $name,
            $price,
            $logo,
            $description
        );

        return $response->withJson($product);
    }

    /**
     * @api {put} /products/:id Update a product information
     * @apiName UpdateProduct
     * @apiGroup Product
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id Product unique ID.
     *
     * @apiSuccess {Number} retailerId Retailer unique ID.
     * @apiSuccess {String} name Product name.
     * @apiSuccess {Number} price Product price.
     * @apiSuccess {File} logo Product image.
     * @apiSuccess {String} description Product description.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": {
     *              "id": 8,
     *              "retailer_id": 3,
     *              "name": "Duff Summer",
     *              "price": 1.5,
     *              "description": "A good choice for summer days.",
     *          }
     *     }
     */
    public function update(Request $request, Response $response, array $args): Response
    {
        $id = (int) $args['id'];
        $retailerId = (int) $request->getParam('retailerId');
        $name = $request->getParam('name');
        $price = (float) $request->getParam('price');
        $description = $request->getParam('description');
        $logo = $request->getUploadedFiles();

        $productBusiness = $this->di->get('productBusiness');
        $product = $productBusiness->update(
            $id,
            $retailerId,
            $name,
            $price,
            $logo,
            $description
        );

        return $response->withJson($product);
    }

    /**
     * @api {delete} /products/:id Delete a product record
     * @apiName DeleteProduct
     * @apiGroup Product
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id Product unique ID.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": {
     *              "id": 8
     *          }
     *     }
     */
    public function delete(Request $request, Response $response, array $args): Response
    {
        $id = (int) $args['id'];

        $productBusiness = $this->di->get('productBusiness');
        $product = $productBusiness->delete($id);

        return $response->withJson($product);
    }

    /**
     * @api {get} /products/:id Show a product informaition
     * @apiName ShowProduct
     * @apiGroup Product
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id Product unique ID.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": {
     *              "id": 8,
     *              "retailer_id": 3,
     *              "name": "Duff Summer",
     *              "price": 1.5,
     *              "logo": "assets/images/products/1560401312.jpg",
     *              "description": "A good choice for summer days."
     *          }
     *     }
     */
    public function show(Request $request, Response $response, array $args): Response
    {
        $id = (int) $args['id'];
        $product = $this->di->get('productRepository')->show($id);

        if (!empty($product)) {
            return $response->withJson($product);
        }

        throw new NotFoundException('Record not found.');
    }

    /**
     * @api {get} /products Show all products informaition
     * @apiName ShowProducts
     * @apiGroup Product
     * @apiVersion 1.0.0
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": [
     *              {
     *                  "id": 8,
     *                  "retailer_id": 3,
     *                  "name": "Duff Summer",
     *                  "price": 1.5,
     *                  "logo": "assets/images/products/1560401312.jpg",
     *                  "description": "A good choice for summer days."
     *              },
     *              {
     *                  "id": 9,
     *                  "retailer_id": 3,
     *                  "name": "Duff Ice",
     *                  "price": 1.65,
     *                  "logo": "assets/images/products/65409871312.jpg",
     *                  "description": "Always a good choice."
     *              },
     *
     *     }
     */
    public function showAll(Request $request, Response $response, array $args): Response
    {
        $products = $this->di->get('productRepository')->showAll();

        if (!empty($products)) {
            return $response->withJson($products);
        }

        throw new NotFoundException('Records not found.');
    }
}
