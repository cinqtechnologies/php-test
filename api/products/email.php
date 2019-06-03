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

	$from_user = "=?UTF-8?B?".base64_encode("PHP Test")."?=";
	$subject = "=?UTF-8?B?".base64_encode("Details of item " . $product->name)."?=";
	$headers =
		"From: $from_user <noreply@localhost>\r\n".
		"MIME-Version: 1.0" . "\r\n" .
		"Content-type: text/html; charset=UTF-8" . "\r\n";

	$message =
		"<img src='http://localhost/" . ($product->image ? $product->image : "images/no_image.png") " . ' style='display: inline-block; width: 100px; vertical-align: middle;'>
		<h1 style='display: inline-block; vertical-align: middle;'>
			" . $product->name; . "<br>
			<small>R$ " . number_format($product->price, 2, '.', ',') . "</small>
		</h1>

		<h2 class='mt-3'>Description</h2>
		<p>" . $product->description . "</p>";

	if (mail($_GET["email"], $subject, $message, $headers)) {
		http_response_code(200);
	}
	else {
		http_response_code(500);
		echo json_encode(
			array(
				"message" => "Couldn't send email.",
				"email" => $message
			);
		);
	}
}
else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No product found.")
    );
}