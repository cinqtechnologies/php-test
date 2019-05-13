<?php
//á
require_once("ProdutoBDParent.class.php");

class ProdutoBD extends ProdutoBDParent {

	public $oConexao;

	function __construct($sBanco){
		$this->oConexao = new Conexao($sBanco);
	}

} 
?>