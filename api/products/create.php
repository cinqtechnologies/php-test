<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/product.php";

// Inicialize pdo
$database = new Database();
$connection = $database->getConnection();

// Get posted data
$data = json_decode(file_get_contents("php://input"));

$product = new Product($connection);

$product->id_retailer = $data->id_retailer;
$product->name = $data->name;
$product->price = $data->price;
$product->image = $data->image;
$product->description = $data->description;

if ($product->create()) {
	http_response_code(201);
}
else {
	http_response_code(404);
    echo json_encode(
        array("message" => "Couldn't create product.")
    );
}