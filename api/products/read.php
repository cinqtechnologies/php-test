<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/product.php";

// Inicialize pdo
$database = new Database();
$connection = $database->getConnection();

// Get itens
$product = new Product($connection);
$stmt = $product->read();

// Proccess data
if ($stmt->rowCount() > 0) {
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

	http_response_code(200);
    echo json_encode($products);
}
else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No products found.")
    );
}