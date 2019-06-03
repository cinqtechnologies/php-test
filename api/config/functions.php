<?php
function valida_post ($rules, &$error_message) {
	// Input checking
	$_funcoes_validacao_tipo = [
		['tipo' => "inteiro", 'validar' => "validar_inteiro", 'mensagem' => "Informe um valor inteiro"],
		['tipo' => "decimal", 'validar' => "validar_decimal", 'mensagem' => "Informe um valor decimal"],
		['tipo' => "email", 'validar' => "validar_email", 'mensagem' => "Informe um email válido"],
		['tipo' => "date", 'validar' => "validar_date", 'mensagem' => "Informe uma data no formato AAAA-MM-DD (ex: 2017-12-31)"],
		['tipo' => "datetime", 'validar' => "validar_datetime", 'mensagem' => "Informe uma data no formato AAAA-MM-DD HH:mm:ss (ex: 2017-12-31 23:59:59)"],
	];

	$error_message = "";
	// Verifica se os esperados foram informados e atendem aos requisitos do tipo correspondente
	foreach($rules as $parametro) {
		$nome_parametro = $parametro["parametro"];

		if (!isset($inputs[$nome_parametro])) {
			$error_message .= "Parâmetro não informado: " . $parametro["nome"] . "<br>";
			continue;
		}

		// Determina os valores a serem validados (array ou valor único)
		if (isset($parametro["is_array"]) && $parametro["is_array"] === true) {
			if (!is_array($inputs[$nome_parametro])) {
				$error_message .= "Parâmetro obrigatório não informado: " . $parametro["nome"] . "<br>";
				continue;
			}
			if ($parametro["requerido"] && empty($inputs[$nome_parametro])) {
				$error_message .= "Parâmetro obrigatório não informado: " . $parametro["nome"] . "<br>";
				continue;
			}

			$entradas = $inputs[$nome_parametro];
		}
		else {
			$entradas = [$inputs[$nome_parametro]];
		}

		// Valida os valores de acordo com o tipo de dado
		foreach ($entradas as $i => $valor) {
			$valor = trim($valor);

			if ($valor === "") { // Parâmetro não informado
				$entradas[$i] = null;
				if ($parametro["requerido"]) { // Parameto obrigatório não informado
					$error_message .= "Parâmetro obrigatório não informado: " . $parametro["nome"] . "<br>";
					break;
				}
			}
			else {
				// Verifica se valor informado atende ao tipo de entrada
				foreach($_funcoes_validacao_tipo as $tipo) {
					if ($tipo["tipo"] === $parametro["tipo"]) {
						$entradas[$i] = $tipo["validar"]($valor);
						break;
					}
				}

				if (is_null($entradas[$i])) { // Parâmetro informado não atende ao tipo
					$error_message .= $parametro["nome"] . " inválido(a). " . $tipo["mensagem"] . "<br>";
					break;
				}
			}
		}

		// Salva os valorel "limpos" em $inputs
		if (isset($parametro["is_array"]) && $parametro["is_array"] === true) {
			$inputs[$nome_parametro] = $entradas;
		}
		else {
			$inputs[$nome_parametro] = $entradas[0];
		}
	}

	if ($error_message !== "")
		return false;

	return true;
}

function validar_post_files ($name, &$mensagem_erro) {
	// Verifica se ocorreu erro no upload
	if (!isset($_FILES[$name]['error']) || is_array($_FILES[$name]['error'])) {
		$mensagem_erro = "Nenhum arquivo submetido";
		return false;
	}
	
	// Verifica se ocorreu erro no upload
	switch ($_FILES[$name]['error']) {
		case UPLOAD_ERR_OK:
			break;
			
		case UPLOAD_ERR_NO_FILE:
			$mensagem_erro = "Nenhum arquivo submetido";
			return false;
			
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			$mensagem_erro = "Arquivo com tamanho superior ao máximo permitido";
			return false;
			
		default:
			$mensagem_erro = "Não foi possível salvar o arquivo";
			return false;
	}
	
	// Verifica tamanho do arquivo
	// if ($_FILES[$name]['size'] > 1000000) {
		// throw new RuntimeException('Exceeded filesize limit.');
	// }

	// Verifica tipo do arquivo
	$finfo = new finfo(FILEINFO_MIME_TYPE);
	$mime_type = $finfo->file($_FILES[$name]['tmp_name']);
	if (!array_search($mime_type, array('pdf' => 'application/pdf'))) {
		$mensagem_erro = "Formato de arquivo inválido, por favor submeta um arquivo pdf";
		return false;
	}

	return true;
}

function validar_inteiro ($valor) {
	if (preg_match("/^\d+$/", $valor)) {
		return intval($valor);
	}
	else
		return null;
}

function validar_decimal ($valor) {
	$valor = str_replace(".", "", $valor);
	$valor = str_replace(",", ".", $valor);

	if (is_numeric($valor))
		return floatval($valor);
	else
		return null;
}

function validar_email ($valor) {
	if (preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/", $valor)) {
		return $valor;
	}
	else {
		return null;
	}
}

function validar_date ($valor) {
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

function validar_datetime ($valor) {
	if ( preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", $valor) ) {
		$data = DateTime::createFromFormat('Y-m-d H:i:s', $valor);

		if ($data)
			return $valor;
		else
			return null;
	}
	else
		return null;
}