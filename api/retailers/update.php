<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/retailer.php";

// Inicialize pdo
$database = new Database();
$connection = $database->getConnection();

// Get posted data
$data = json_decode(file_get_contents("php://input"));

$retailer = new Retailer($connection);

$retailer->id = $data->id;
$retailer->name = $data->name;
$retailer->website = $data->website;
$retailer->description = $data->description;
$retailer->logo = $data->logo;

if ($retailer->update()) {
	http_response_code(200);
}
else {
	http_response_code(404);
    echo json_encode(
        array("message" => "Product not found found.")
    );
}