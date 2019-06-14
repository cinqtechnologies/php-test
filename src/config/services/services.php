<?php

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$container['logger'] = function () {
    $logger = new \Monolog\Logger('ecommerce');
    $fileHandler = new \Monolog\Handler\StreamHandler(
        getenv('LOG_PATH') . 'app.log'
    );
    $logger->pushHandler($fileHandler);
    return $logger;
};

$container['storage'] = function (ContainerInterface $di) {
    $db = $di['settings']['db'];

    $pdo = new PDO(
        'mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'],
        $db['pass']
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $pdo;
};

$container['errorHandler'] = function (ContainerInterface $di) {
    return function (
        Request $request,
        Response $response,
        \Exception $exception
    ) use ($di) {
        if ('development' === getenv('APPLICATION_ENV')) {
            $di['logger']->addCritical(sprintf(
                'Message: %s. Code: %s. File: %s. Line: %s',
                $exception->getMessage(),
                $exception->getCode(),
                $exception->getFile(),
                $exception->getLine()
            ));
        }

        $content = [
            'error' => [
                'code' => $exception->getCode(),
                'type' => (new \ReflectionClass($exception))->getShortName(),
                'message' => $exception->getMessage(),
            ]
        ];

        switch ($exception->getCode()) {
            case 405:
                return $response->withStatus(401)->withJson($content);
            default:
                return $response->withStatus(400)->withJson($content);
        }
    };
};

require 'repositories.php';
require 'entities.php';
require 'business.php';
