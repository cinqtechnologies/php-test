<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/product.php";

// Inicialize pdo
$database = new Database();
$connection = $database->getConnection();

// Get product
if (!isset($_GET["id"]) || empty($_GET["id"])) {
	http_response_code(404);
    echo json_encode(
        array("message" => "No product found.")
    );
}

$product = new Product($connection);
$product->id = intval($_GET["id"]);

if ($product->get()) {
	http_response_code(200);
    echo json_encode($product->to_array());
}
else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No product found.")
    );
}