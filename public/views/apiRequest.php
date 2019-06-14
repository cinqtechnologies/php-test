<?php

function apiRequest($method, $endpoint, $data = [])
{
    $url = sprintf('%s%s', getApiBaseUrl(), $endpoint);
    $curl = curl_init();

    switch ($method) {
        case 'POST':
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case 'PUT':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            break;
        case 'DELETE':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            break;
        case 'GET':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            $url = sprintf('%s?%s', $url, http_build_query($data));
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($curl);

    if (true != $response) {
        die('API response error: ' . curl_error($curl));
    }

    curl_close($curl);

    return $response;
}

function getApiBaseUrl()
{
    return '127.0.0.1:8081';
}