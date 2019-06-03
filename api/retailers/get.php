<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/retailer.php";
include_once "../objects/product.php";

// Inicialize pdo
$database = new Database();
$connection = $database->getConnection();

// Get retailers
if (!isset($_GET["id"]) || empty($_GET["id"])) {
	http_response_code(404);
    echo json_encode(
        array("message" => "No retailer found.")
    );
}

$retailer = new Retailer($connection);
$retailer->id = intval($_GET["id"]);

if ($retailer->get()) {
	http_response_code(200);

	$product = new Product($connection);
	$stmt = $product->search_by_retailer($retailer->id);
	
	$products = [];
	while ($row = $stmt->fetch()) {
		$products[] = [
			"id" => $row["id"],
			"id_retailer" => $row["id_retailer"],
			"name" => $row["name"],
			"price" => $row["price"],
			"image" => $row["image"],
			"description" => $row["description"]
		];
	}
	
	$retailer = $retailer->to_array();
	$retailer["products"] = $products;
	
    echo json_encode($retailer);
}
else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No products found.")
    );
}