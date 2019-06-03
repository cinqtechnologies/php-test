<?php
require __DIR__ . "/config.php";

// Only get OR post
if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
	header('HTTP/1.0 405 Method Not Allowed', true, 405);
	exit();
}

// Error Handling
function send_response ($response, $status = "success") {
	$response["status"] = $status;
	
	echo json_encode($response);
	exit();
}

function myErrorHandler ($errno, $errstr) {
	$data = array();
	$data["message"] = $errstr;
	
	switch ($errno) {
		case E_USER_ERROR:
			send_response($data, "error");
			break;

		case E_USER_WARNING:
			send_response($data, "warning");
			break;

		case E_USER_NOTICE:
			send_response($data, "notice");
			break;

		default:
			send_response("", "unknown");
			break;
	}
}

set_error_handler("myErrorHandler", E_USER_ERROR | E_USER_WARNING | E_USER_NOTICE);

function validate_post ($parametros, &$message) {
	// Input checking
	$_funcoes_validacao_tipo = [
		['type' => "integer", 'validator' => "validate_integer", 'message' => "Value must be an integer."],
		['type' => "decimal", 'validator' => "validate_decimal", 'message' => "Value must be a decimal."],
		['type' => "email", 'validator' => "validate_email", 'message' => "Value must be a valid email."],
		['type' => "date", 'validator' => "validate_date", 'message' => "Value must be a date."],
		['type' => "datetime", 'validator' => "validate_datetime", 'message' => "Value must be a datetime."],
	];

	$message = "";
	
	// Verifica se os esperados foram informados e atendem aos requisitos do type correspondente
	foreach($parametros as $parameter) {
		$nome_parametro = $parameter["parameter"];

		if (!isset($_POST[$nome_parametro])) {
			$message .= "Missing parameter: " . $parameter["name"] . "<br>";
			continue;
		}

		// Determina os valores a serem validados (array ou valor único)
		if (isset($parameter["is_array"]) && $parameter["is_array"] === true) {
			if (!is_array($_POST[$nome_parametro])) {
				$message .= "Missing parameter: " . $parameter["name"] . "<br>";
				continue;
			}
			if ($parameter["required"] && empty($_POST[$nome_parametro])) {
				$message .= "Missing parameter: " . $parameter["name"] . "<br>";
				continue;
			}
			
			$entradas = $_POST[$nome_parametro];
		}
		else {
			$entradas = [$_POST[$nome_parametro]];
		}
		
		// Valida os valores de acordo com o type de dado
		foreach ($entradas as $i => $valor) {
			$valor = trim($valor);
			
			if ($valor === "") { // Parâmetro não informado
				$entradas[$i] = null;
				if ($parameter["required"]) { // Parameto obrigatório não informado
					$message .= "Missing parameter: " . $parameter["name"] . "<br>";
					break;
				}
			}
			else {
				// Verifica se valor informado atende ao type de entrada
				foreach($_funcoes_validacao_tipo as $type) {
					if ($type["type"] === $parameter["type"]) {
						$entradas[$i] = $type["validator"]($valor);
						break;
					}
				}
				
				if (is_null($entradas[$i])) { // Parâmetro informado não atende ao type
					$message .= "Invalid value for " . $parameter["name"] . ". " . $type["message"] . "<br>";
					break;
				}
			}
		}
		
		// Salva os valorel "limpos" em $_POST
		if (isset($parameter["is_array"]) && $parameter["is_array"] === true) {
			$_POST[$nome_parametro] = $entradas;
		}
		else {
			$_POST[$nome_parametro] = $entradas[0];
		}
	}

	if ($message !== "")
		return false;

	return true;
}

function validate_post_files ($name, &$message) {
	// Verifica se ocorreu erro no upload
	if (!isset($_FILES[$name]['error']) || is_array($_FILES[$name]['error'])) {
		$message = "No file submited.";
		return false;
	}

	// Verifica se ocorreu erro no upload
	switch ($_FILES[$name]['error']) {
		case UPLOAD_ERR_OK:
			break;
			
		case UPLOAD_ERR_NO_FILE:
			$message = "No file submited.";
			return false;
			
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			$message = "File is too big.";
			return false;
			
		default:
			$message = "Couldn't save submited file.";
			return false;
	}
	

	// Verifica type do arquivo
	$type = strtolower(pathinfo($_FILES[$name]["name"], PATHINFO_EXTENSION));
	if (!in_array($type, ["pdf", "jpg", "png"])) {
		$message = "Invalid file type. Allowed type are .pdf, .png and .jpg";
		return false;
	}

	return true;
}




function validate_integer ($valor) {
	if (preg_match("/^\d+$/", $valor)) {
		return intval($valor);
	}
	else {
		return null;
	}
}

function validate_decimal ($valor) {
	if (is_numeric($valor))
		return floatval($valor);
	else
		return null;
}

function validate_email ($valor) {
	if (preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/", $valor)) {
		return $valor;
	}
	else {
		return null;
	}
}

function validate_date ($valor) {
	if ( preg_match("/^\d{4}-\d{2}-\d{2}$/", $valor) ) {
		$data = date('Y-m-d', strtotime($valor));

		if ($data === $valor)
			return $valor;
		else
			return null;
	}
	else
		return null;
}

function validate_datetime ($valor) {
	if ( preg_match("/^\d{4}-\d{2}-\d{2} d{2}:d{2}:d{2}$/", $valor) ) {
		$data = date("Y-m-d H:i:s", strtotime($valor));

		if ($data === $valor)
			return $valor;
		else
			return null;
	}
	else
		return null;
}