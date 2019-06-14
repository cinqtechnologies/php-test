<?php

require __DIR__ . '/../vendor/autoload.php';

use Ecommerce\Http\Middlewares\ResponseMetadata;
use Ecommerce\Http\Middlewares\ResponseValidation;
use Ecommerce\Http\Middlewares\TokenValidation;
use Dotenv\Dotenv;

(new Dotenv(__DIR__ . '/../src/config'))->load();

if (!is_dir(getenv('LOG_PATH'))) {
    die(
        sprintf(
            'Directory "%s" does not exist. Please run the command "make logs-directory"',
            getenv('LOG_PATH')
        )
    );
}

$config = [
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'host' => getenv('DB_HOST'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASS'),
            'dbname' => getenv('DB_NAME'),
        ]
    ],
];

$container = new \Slim\Container($config);

require __DIR__ . '/../src/config/services/services.php';

$app = new \Slim\App($container);

foreach (glob(__DIR__ . '/../src/config/routes/*.php') as $route) {
    require $route;
}

$app->add(new ResponseMetadata());
// $app->add(new ResponseValidation());

$app->run();
