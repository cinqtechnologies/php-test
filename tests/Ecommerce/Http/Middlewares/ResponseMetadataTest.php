<?php

declare(strict_types=1);

namespace Tests\Http\Middlewares;

use Ecommerce\Http\Middlewares\MiddlewareInterface;
use Ecommerce\Http\Middlewares\ResponseMetadata;
use Psr\Http\Message\ServerRequestInterface;
use Mockery as m;

class ResponseMetadataTest extends \Tests\TestCase
{
    public function testItMustIncludeMetadataToTheResponseContent(): void
    {
        $request = m::mock(ServerRequestInterface::class);
        $response = (new \Slim\Http\Response())->withJson(['foo' => 'bar']);
        $callable = function($request, $response) {
            return $response;
        };

        $middleware = new ResponseMetadata();
        $response = $middleware($request, $response, $callable);

        $expected = [
            'data' => [
                'foo' => 'bar'
            ]
        ];

        $actual = json_decode((string) $response->getBody(), true);

        $this->assertArraySubset(
            $expected,
            $actual,
            'Response should have the metadata part'
        );
    }
}
