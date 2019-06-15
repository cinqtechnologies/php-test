<?php
declare(strict_types=1);

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Validators\RetailerCreateValidator;
use App\Validators\RetailerUpdateValidator;
use App\Validators\RetailerDeleteValidator;
use App\RouteApi\Retailer\RetailerCreateApi;
use App\RouteApi\Retailer\RetailerUpdateApi;
use App\RouteApi\Retailer\RetailerRetrieveApi;
use App\RouteApi\Retailer\RetailerDeleteApi;

class RetailerController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Exception
     */
    public function create(Request $request, Response $response)
    {
        die('retailer save');
    }

    public function update(Request $request, Response $response)
    {
        die('retailer save');
    }

    public function delete(Request $request, Response $response)
    {
        die('retailer delete');
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
        $api = new RetailerRetrieveApi();
        $api->handle($parameters);

        return $response->withJson($api->getPayload());
    }
}