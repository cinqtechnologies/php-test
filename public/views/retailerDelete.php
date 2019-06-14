<?php

require_once('apiRequest.php');

$id = (int) $_GET['id'];
$endpoint = '/retailers/' . $id;

$response = apiRequest('DELETE', $endpoint);

echo '<pre>';
print_r(json_decode($response, true));
