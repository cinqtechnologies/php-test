<?php
declare(strict_types=1);

namespace App\Controllers;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Validators\ProductCreateValidator;
use App\Validators\ProductUpdateValidator;
use App\RouteApi\Product\ProductCreateApi;
use App\RouteApi\Product\ProductUpdateApi;

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
     * @param int $id
     * @return Response
     */
    public function delete(Request $request, Response $response, int $id)
    {
        $params = $request->getParsedBody();

        $api = new ProductDeleteApi($id);
        $api->handle($params);

        return $response->withJson($api->getPayload());
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param int|null $id
     * @return Response
     */
    public function retrieve(Request $request, Response $response, int $id = null)
    {
        $params = $request->getParsedBody();

        $api = new ProductRetrieveApi($id);
        $api->handle($params);

        return $response->withJson($api->getPayload());
    }
}