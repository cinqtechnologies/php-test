<?php
declare(strict_types=1);

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Validators\ProductCreateValidator;
use App\Validators\ProductUpdateValidator;
use App\Validators\ProductDeleteValidator;
use App\RouteApi\Product\ProductCreateApi;
use App\RouteApi\Product\ProductUpdateApi;
use App\RouteApi\Product\ProductRetrieveApi;
use App\RouteApi\Product\ProductDeleteApi;

class ProductController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Exception
     */
    public function create(Request $request, Response $response)
    {
        $params = $request->getParsedBody();

        $validator = new ProductCreateValidator();
        $errors = $validator->validate($params);
        if ($errors) {
            return $response->withJson($errors, 404);
        }

        $api = new ProductCreateApi();
        $api->handle($params);

        return $response->withJson($api->getPayload());
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Exception
     */
    public function update(Request $request, Response $response)
    {
        $params = $request->getParsedBody();

        $validator = new ProductUpdateValidator();
        $errors = $validator->validate($params);
        if ($errors) {
            return $response->withJson($errors, 404);
        }

        $api = new ProductUpdateApi();
        $api->handle($params);

        return $response->withJson($api->getPayload());
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $parameters
     * @return Response
     * @throws \Exception
     */
    public function delete(Request $request, Response $response, array $parameters)
    {
        $validator = new ProductDeleteValidator();
        $errors = $validator->validate($parameters);
        if ($errors) {
            return $response->withJson($errors, 404);
        }

        $api = new ProductDeleteApi();
        $api->handle($parameters);

        return $response->withJson($api->getPayload());
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $parameters
     * @return Response
     * @throws \Exception
     */
    public function retrieve(Request $request, Response $response, array $parameters)
    {
        $api = new ProductRetrieveApi();
        $api->handle($parameters);

        return $response->withJson($api->getPayload());
    }
}