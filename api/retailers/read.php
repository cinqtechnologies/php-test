<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/retailer.php";

// Inicialize pdo
$database = new Database();
$connection = $database->getConnection();

// Get retailers
$retailer = new Retailer($connection);
$stmt = $retailer->read();

// Proccess data
if ($stmt->rowCount() > 0) {
	$retailers = [];
	while ($row = $stmt->fetch()) {
		$retailers[] = [
			"id" => $row["id"],
			"name" => $row["name"],
			"logo" => $row["logo"],
			"description" => $row["description"],
			"website" => $row["website"]
		];
	}
	
	http_response_code(200);
    echo json_encode($retailers);
}
else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No retailers found.")
    );
}