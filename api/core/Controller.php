<?php
require_once("../constantes.php");
require_once(PATH."/classes/Conexao.class.php");

class controller {

	public function __construct() {
		$oConexao = new Conexao(BANCO);
	}
	
	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {
		include 'views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function returnJson($array) {
		header("Content-Type: application/json");
		echo json_encode($array);
		exit;
	}

}