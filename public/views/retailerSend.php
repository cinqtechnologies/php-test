<?php

require_once('apiRequest.php');

$data = [
    'id' => $_POST['id'] > 0 ? (int) $_POST['id'] : 0,
    'name' => $_POST['name'],
    'description' => $_POST['description'],
    'website' => $_POST['website'],
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
$endpoint = '/retailers';

if ($data['id'] > 0) {
    $method = 'PUT';
    $endpoint = '/retailers/' . $data['id'];
}

$response = apiRequest($method, $endpoint, $data);
$response = json_decode($response, true);

if (isset($response['data']['validation'])) {
    $msg = '';
    foreach ($response['data'] as $validationMessage) {
        foreach ($validationMessage as $field => $message) {
            $msg .= sprintf('<div class="alert alert-warning" role="alert">%s: %s</div>', $field, reset($message));
        }
    }
    header('Location: index.php?page=retailerForm&msg=' . $msg);
    return;
}

if (!isset($response['data'])) {
    $msg = '<div class="alert alert-danger" role="alert">Something went wront when trying to save the retailer.</div>';
}

$msg = '<div class="alert alert-success" role="alert">Retailer has been saved successfuly.</div>';
header('Location: index.php?page=retailerForm&msg=' . $msg);