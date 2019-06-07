<?php
declare(strict_types=1);

namespace App\Controllers;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Validators\ProductCreateValidator;
use App\RouteApi\Product\ProductCreateApi;

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

        $productCreateApi = new ProductCreateApi();
        $productCreateApi->handle($params);

        return $response->withJson($productCreateApi->getPayload());
    }

    public function update(Request $request, Response $response)
    {
        die('product save');
    }

    public function delete(Request $request, Response $response)
    {
        die('product delete');
    }

    public function retrieve(Request $request, Response $response)
    {
        die('product retrieve');
    }
}