<?php
require_once("../constantes.php");
require_once(PATH."/classes/Conexao.class.php");

class model {

	public function __construct() {
		$oConexao = new Conexao(BANCO);
	}

}
?>