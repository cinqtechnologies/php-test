<?php
//á
require_once("VarejistaParent.class.php");

class Varejista extends VarejistaParent {
	
	/**
	* Construtor de Varejista
	* @param $nId Id
	* @param $sNmVarejista NmVarejista
	* @param $sDescVarejista DescVarejista
	* @param $sSite Site
	* @param $sLogo Logo
	* @param $dDtCriacao DtCriacao
	* @param $bPublicado Publicado
	* @param $bAtivo Ativo
	*/
	function __construct($nId,$sNmVarejista,$sDescVarejista,$sSite,$sLogo,$dDtCriacao,$bPublicado,$bAtivo){
		$this->setId($nId);
		$this->setNmVarejista($sNmVarejista);
		$this->setDescVarejista($sDescVarejista);
		$this->setSite($sSite);
		$this->setLogo($sLogo);
		$this->setDtCriacao($dDtCriacao);
		$this->setPublicado($bPublicado);
		$this->setAtivo($bAtivo);
		
	}
	
}
?>