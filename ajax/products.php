<?php
include __DIR__ . "/../lib/config_ajax.php";

if ( !isset($_POST["action"]) )
	trigger_error("Invalid action.", E_USER_ERROR);

$response = ["status" => "success"];

switch($_POST["action"]) {
	case "create":
		create();
		break;

	case "update":
		update();
		break;

	case "send_email":
		send_email();
		break;

	default:
		trigger_error("Invalid action.", E_USER_ERROR);
}

echo json_encode($response);

// ------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------
function create () {
	global $pdo;
	global $response;

	// Valida entradas
	$message = "";
	$entradas = [
		['name' => "Retailer", 'parameter' => "id_retailer", 'required' => false, 'type' => "integer"],
		['name' => "Name", 'parameter' => "name", 'required' => false, 'type' => "text"],
		['name' => "Price", 'parameter' => "price", 'required' => false, 'type' => "decimal"],
		['name' => "Description", 'parameter' => "description", 'required' => false, 'type' => "text"],
	];
	if (!validate_post($entradas, $message))
		trigger_error($message, E_USER_ERROR);

	if (isset($_FILES["image"])) {
		if (!validate_post_files("image", $mesage))
			trigger_error("Invalid parameter: Image. " . $message, E_USER_ERROR);

		$file_path = "uploads/products/";
		$file_type = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
		$file_name = get_randon_token(16) . ".$file_type";

		if (!move_uploaded_file($_FILES["image"]['tmp_name'], "../" . $file_path . $file_name))
			trigger_error("Couldn't save submited file.", E_USER_ERROR);

		$_POST["image"] = $file_path . $file_name;
	}

	// cURL create
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, API_URL . "products/create.php");
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($_POST));
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, API_SECURE);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($curl);

	$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	if ($temp = curl_error($curl)) {
		curl_close ($curl);

		$result = json_decode($result);
		trigger_error($result->message, E_USER_ERROR);
	}
	else if ($httpCode >= 300) {
		$result = json_decode($result);
		trigger_error($result->message, E_USER_ERROR);
	}
}

function update () {
	global $pdo;
	global $response;

	// Valida entradas
	$message = "";
	$entradas = [
		['name' => "Product", 'parameter' => "id", 'required' => false, 'type' => "integer"],
		['name' => "Retailer", 'parameter' => "id_retailer", 'required' => false, 'type' => "integer"],
		['name' => "Name", 'parameter' => "name", 'required' => false, 'type' => "text"],
		['name' => "Price", 'parameter' => "price", 'required' => false, 'type' => "decimal"],
		['name' => "Description", 'parameter' => "description", 'required' => false, 'type' => "text"],
	];
	if (!validate_post($entradas, $message))
		trigger_error($message, E_USER_ERROR);

	$_POST["logo"] = "";
	if (isset($_FILES["image"])) {
		if (!validate_post_files("image", $mesage))
			trigger_error("Invalid parameter: Image. " . $message, E_USER_ERROR);

		$file_path = "uploads/products/";
		$file_type = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
		$file_name = get_randon_token(16) . ".$file_type";

		if (!move_uploaded_file($_FILES["image"]['tmp_name'], "../" . $file_path . $file_name))
			trigger_error("Couldn't save submited file.", E_USER_ERROR);

		$_POST["image"] = $file_path . $file_name;
	}


	// cURL edit
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, API_URL . "products/update.php?id=$_POST[id]");
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($_POST));
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, API_SECURE);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($curl);

	$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	if ($temp = curl_error($curl)) {
		curl_close ($curl);

		$result = json_decode($result);
		trigger_error($result->message, E_USER_ERROR);
	}
	else if ($httpCode >= 300) {
		$result = json_decode($result);
		trigger_error($result->message, E_USER_ERROR);
	}
}

function send_email () {
	global $pdo;
	global $response;
	
	$message = "";
	$entradas = [
		['name' => "Product", 'parameter' => "id", 'required' => false, 'type' => "integer"],
		['name' => "Email", 'parameter' => "email", 'required' => false, 'type' => "email"],
	];
	if (!validate_post($entradas, $message))
		trigger_error($message, E_USER_ERROR);
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, API_URL . "products/email.php?id=$_POST[id]&email=" . urlencode($_POST["email"]));
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, API_SECURE);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	
	$result = curl_exec($curl);

	$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	if ($temp = curl_error($curl)) {
		curl_close ($curl);

		$result = json_decode($result);
		trigger_error($result->message, E_USER_ERROR);
	}
	else if ($httpCode == 500) {
		$result = json_decode($result);
		$response["email"] = $result->email;
		trigger_error($result->message, E_USER_NOTICE);
	}
	else if ($httpCode >= 300) {
		$result = json_decode($result);
		trigger_error($result->message, E_USER_ERROR);
	}
}