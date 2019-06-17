<?php
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

$configBase = [
    'db' => [
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'name' => 'ecommerce'
    ]
];

return $configBase;
