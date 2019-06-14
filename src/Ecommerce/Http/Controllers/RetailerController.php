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
class RetailerController extends ApiController
{

    /**
     * @api {post} /retailers Create a retailer
     * @apiName CreateRetailer
     * @apiGroup Retailer
     * @apiVersion 1.0.0
     *
     * @apiSuccess {String} name Retailer name.
     * @apiSuccess {File} logo Retailer image.
     * @apiSuccess {String} description Retailer description.
     * @apiSuccess {String} website Retailer website.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": {
     *              "name": "Duff",
     *              "logo": "assets/images/retailers/1560399890.jpg",
     *              "description": "The best beer from Springfield",
     *              "website": "https://www.duff.com"
     *          }
     *     }
     */
    public function create(Request $request, Response $response): Response
    {
        $name = $request->getParam('name');
        $description = $request->getParam('description');
        $website = $request->getParam('website');
        $logo = $request->getUploadedFiles();

        $retailerBusiness = $this->di->get('retailerBusiness');
        $retailer = $retailerBusiness->add(
            $name,
            $logo,
            $description,
            $website
        );

        return $response->withJson($retailer);
    }

    /**
     * @api {put} /retailers/:id Update a retailer information
     * @apiName UpdateRetailer
     * @apiGroup Retailer
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id Retailer unique ID.
     *
     * @apiSuccess {String} name Retailer name.
     * @apiSuccess {File} logo Retailer image.
     * @apiSuccess {String} description Retailer description.
     * @apiSuccess {String} website Retailer website.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": {
     *              "name": "Duff",
     *              "logo": "assets/images/retailers/1560399890.jpg",
     *              "description": "The best beer from Springfield",
     *              "website": "https://www.duff.com"
     *              "id": 1
     *          }
     *     }
     */
    public function update(Request $request, Response $response, array $args): Response
    {
        $id = (int) $args['id'];
        $name = $request->getParam('name');
        $description = $request->getParam('description');
        $website = $request->getParam('website');
        $logo = $request->getUploadedFiles();

        $retailerBusiness = $this->di->get('retailerBusiness');
        $retailer = $retailerBusiness->update(
            $id,
            $name,
            $logo,
            $description,
            $website
        );

        return $response->withJson($retailer);
    }

    /**
     * @api {delete} /retailers/:id Delete a retailer record
     * @apiName DeleteRetailer
     * @apiGroup Retailer
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id Retailer unique ID.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": {
     *              "id": 1
     *          }
     *     }
     */
    public function delete(Request $request, Response $response, array $args): Response
    {
        $id = (int) $args['id'];

        $retailerBusiness = $this->di->get('retailerBusiness');
        $retailer = $retailerBusiness->delete($id);

        return $response->withJson($retailer);
    }

    /**
     * @api {get} /retailers/:id Show a retailer information
     * @apiName ShowRetailer
     * @apiGroup Retailer
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id Retailer unique ID.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": {
     *              "id": 1
     *              "name": "Duff",
     *              "logo": "assets/images/retailers/1560399890.jpg",
     *              "description": "The best beer from Springfield",
     *              "website": "https://www.duff.com"
     *          }
     *     }
     */
    public function show(Request $request, Response $response, array $args): Response
    {
        $id = (int) $args['id'];
        $retailer = $this->di->get('retailerRepository')->show($id);

        if (!empty($retailer)) {
            return $response->withJson($retailer);
        }

        throw new NotFoundException('Record not found.');
    }

    /**
     * @api {get} /retailers Show all retailer information
     * @apiName ShowRetailers
     * @apiGroup Retailer
     * @apiVersion 1.0.0
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": [
     *              {
     *                  "id": 1
     *                  "name": "Duff",
     *                  "logo": "assets/images/retailers/1560399890.jpg",
     *                  "description": "The best beer from Springfield",
     *                  "website": "https://www.duff.com"
     *              },
     *              {
     *                  "id": 2
     *                  "name": "Los Pollos Hermanos",
     *                  "logo": "assets/images/retailers/6327399993.jpg",
     *                  "description": "We deliver where you are",
     *                  "website": "https://www.lospolloshermanos.com"
     *              },
     *          ]
     *     }
     */
    public function showAll(Request $request, Response $response, array $args): Response
    {
        $retailers = $this->di->get('retailerRepository')->showAll();

        if (!empty($retailers)) {
            return $response->withJson($retailers);
        }

        throw new NotFoundException('Records not found.');
    }

    /**
     * @api {get} /retailers/:id/products Show all retailer products
     * @apiName ShowRetailerProducts
     * @apiGroup Retailer
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id Retailer unique ID.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": [
     *              {
     *                  "id": 1,
     *                  "retailer_id": 2,
     *                  "name": "Wallet",
     *                  "price": 2.99,
     *                  "logo": "assets/images/products/1560466562.jpg",
     *                  "description": "Protect your money!"
     *              },
     *              {
     *                  "id": 2,
     *                  "retailer_id": 2,
     *                  "name": "Purse",
     *                  "price": 29.99,
     *                  "logo": "assets/images/products/1560466700.jpg",
     *                  "description": "Enjoy the best of life."
     *              }
     *          ]
     *     }
     */
    public function showAllProducts(Request $request, Response $response, array $args): Response
    {
        $retailerId = (int) $args['id'];
        $products = $this->di->get('productRepository')->getByRetailerId($retailerId);

        if (!empty($products)) {
            return $response->withJson($products);
        }

        throw new NotFoundException('Records not found.');
    }
}
