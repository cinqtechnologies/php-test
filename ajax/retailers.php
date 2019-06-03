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
		['name' => "Name", 'parameter' => "name", 'required' => false, 'type' => "text"],
		['name' => "Website", 'parameter' => "website", 'required' => false, 'type' => "url"],
		['name' => "Description", 'parameter' => "description", 'required' => false, 'type' => "text"],
	];
	if (!validate_post($entradas, $message))
		trigger_error($message, E_USER_ERROR);

	$_POST["logo"] = "";
	if (isset($_FILES["logo"])) {		
		if (!validate_post_files("logo", $mesage))
			trigger_error("Invalid parameter: Logo. " . $message, E_USER_ERROR);

		$file_path = "uploads/retailers/";
		$file_type = strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));
		$file_name = get_randon_token(16) . ".$file_type";
		
		if (!move_uploaded_file($_FILES["logo"]['tmp_name'], "../" . $file_path . $file_name))
			trigger_error("Couldn't save submited file.", E_USER_ERROR);

		$_POST["logo"] = $file_path . $file_name;
	}

	// cURL create
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, API_URL . "retailers/create.php");
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
		['name' => "Retailer", 'parameter' => "id", 'required' => false, 'type' => "integer"],
		['name' => "Name", 'parameter' => "name", 'required' => false, 'type' => "text"],
		['name' => "Website", 'parameter' => "website", 'required' => false, 'type' => "url"],
		['name' => "Description", 'parameter' => "description", 'required' => false, 'type' => "text"],
	];
	if (!validate_post($entradas, $message))
		trigger_error($message, E_USER_ERROR);

	$_POST["logo"] = "";
	if (isset($_FILES["logo"]) && is_uploaded_file($_FILES["logo"]["tmp_name"])) {
		if (!validate_post_files("logo", $message))
			trigger_error("Invalid parameter: Logo. " . $message, E_USER_ERROR);

		$file_path = "uploads/retailers/";
		$file_type = strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));
		$file_name = get_randon_token(16) . ".$file_type";
		
		if (!move_uploaded_file($_FILES["logo"]['tmp_name'], "../" . $file_path . $file_name))
			trigger_error("Couldn't save submited file.", E_USER_ERROR);

		$_POST["logo"] = $file_path . $file_name;
	}

	
	// cURL edit
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, API_URL . "retailers/update.php?id=$_POST[id]");
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