<?php

require_once('apiRequest.php');

$data = [
    'id' => $_POST['id'] > 0 ? (int) $_POST['id'] : 0,
    'retailerId' => (int) $_POST['retailerId'],
    'name' => $_POST['name'],
    'price' => (float) $_POST['price'],
    'description' => $_POST['description'],
];

if ('' !== $_FILES['logo']['tmp_name']) {
    $curlFile = new CURLFile(
        $_FILES['logo']['tmp_name'],
        $_FILES['logo']['type'],
        $_FILES['logo']['name']
    );

    $data['logo'] = $curlFile;
}

$method = 'POST';
$endpoint = '/products';

if ($data['id'] > 0) {
    $method = 'PUT';
    $endpoint = '/products/' . $data['id'];
}

$response = apiRequest($method, $endpoint, $data);
$response = json_decode($response, true);

if (!isset($response['data'])) {
    $msg = '<div class="alert alert-danger" role="alert">Something went wront when trying to save the product.</div>';
}

$msg = '<div class="alert alert-success" role="alert">Product has been saved successfuly.</div>';
header('Location: index.php?page=productForm&msg=' . $msg);
