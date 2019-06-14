<?php

declare(strict_types=1);

namespace Ecommerce\Http\Middlewares;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class ResponseMetadata
{
    public function __invoke(Request $request, Response $response, callable $next): Response
    {
        $response = $next($request, $response);
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');

        $body = json_decode((string) $response->getBody(), true);

        return $response->withJson(['data' => $body]);
    }
}
