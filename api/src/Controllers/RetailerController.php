<?php
declare(strict_types=1);

namespace App\Controllers;
use Slim\Http\Request;
use Slim\Http\Response;

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

    public function retrieve(Request $request, Response $response)
    {
        die('retailer retrieve');
    }
}