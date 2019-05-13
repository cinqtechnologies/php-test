<?php
require_once("../constantes.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");

class Varejistas extends model {
	
	public function listarTodos() {
		$oFachadaConteudo = new FachadaConteudoBD();
		$vWhereVarejista = array("publicado = 1","ativo = 1");
		$voVarejista = $oFachadaConteudo->recuperaTodosVarejista(BANCO,$vWhereVarejista);
		foreach($voVarejista as $nIndice => $oVarejista){
            $oVarejista->setNmVarejista(utf8_decode($oVarejista->getNmVarejista()));
            $oVarejista->setDescVarejista(utf8_decode($oVarejista->getDescVarejista()));
        }
		return $voVarejista;
	}


	public function detalhes($nIdVarejista){
		$oFachadaConteudo = new FachadaConteudoBD();
		$oVarejista = $oFachadaConteudo->recuperaVarejista($nIdVarejista,BANCO);
		$oVarejista->setNmVarejista(utf8_decode($oVarejista->getNmVarejista()));
        $oVarejista->setDescVarejista(utf8_decode($oVarejista->getDescVarejista()));
		return $oVarejista;
	}
	

}