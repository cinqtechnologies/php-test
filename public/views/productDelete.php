<?php

require_once('apiRequest.php');

$id = (int) $_GET['id'];
$retailerId = (int) $_GET['retailerId'];
$endpoint = '/products/' . $id;

$response = apiRequest('DELETE', $endpoint);

echo '<pre>';
print_r(json_decode($response, true));

if (!isset($response['data'])) {
    $msg = '<div class="alert alert-danger" role="alert">Something went wront when trying to delete this product.</div>';
}

$msg = '<div class="alert alert-success" role="alert">Product has been deleted successfuly.</div>';
header("Location: index.php?page=retailerView&id=$retailerId&msg=$msg");
