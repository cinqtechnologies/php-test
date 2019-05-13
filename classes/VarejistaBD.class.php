<?php
//á
require_once("VarejistaBDParent.class.php");

class VarejistaBD extends VarejistaBDParent {

	public $oConexao;

	function __construct($sBanco){
		$this->oConexao = new Conexao($sBanco);
	}

} 
?>