<?php
require_once("../constantes.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");

class Produtos extends model {
	
	public function listarTodos() {
		$oFachadaConteudo = new FachadaConteudoBD();
		$vWhereProduto = array("publicado = 1","ativo = 1");
		$voProduto = $oFachadaConteudo->recuperaTodosProduto(BANCO,$vWhereProduto);
		foreach($voProduto as $nIndice => $oProduto){
            $oProduto->setNmProduto(utf8_decode($oProduto->getNmProduto()));
            $oProduto->setDescProduto(utf8_decode($oProduto->getDescProduto()));
        }
		return $voProduto;
	}

	public function listarTodosPorVarejista($nIdVarejista) {
		$oFachadaConteudo = new FachadaConteudoBD();
		$vWhereProduto = array("publicado = 1","ativo = 1","id_varejista = ".$nIdVarejista);
		$voProduto = $oFachadaConteudo->recuperaTodosProduto(BANCO,$vWhereProduto);
		foreach($voProduto as $nIndice => $oProduto){
            $oProduto->setNmProduto(utf8_decode($oProduto->getNmProduto()));
            $oProduto->setDescProduto(utf8_decode($oProduto->getDescProduto()));
        }
		return $voProduto;
	}

	public function detalhes($nIdProduto){
		$oFachadaConteudo = new FachadaConteudoBD();
		$oProduto = $oFachadaConteudo->recuperaProduto($nIdProduto,BANCO);
		$oProduto->setNmProduto(utf8_decode($oProduto->getNmProduto()));
        $oProduto->setDescProduto(utf8_decode($oProduto->getDescProduto()));
		return $oProduto;
	}
	

}