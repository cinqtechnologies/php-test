<?php
//á
require_once("ProdutoParent.class.php");

class Produto extends ProdutoParent {
	
	/**
	* Construtor de Produto
	* @param $nId Id
	* @param $nIdVarejista IdVarejista
	* @param $sNmProduto NmProduto
	* @param $sDescProduto DescProduto
	* @param $nPreco Preco
	* @param $sImagem Imagem
	* @param $dDtCriacao DtCriacao
	* @param $bPublicado Publicado
	* @param $bAtivo Ativo
	*/
	function __construct($nId,$nIdVarejista,$sNmProduto,$sDescProduto,$nPreco,$sImagem,$dDtCriacao,$bPublicado,$bAtivo){
		$this->setId($nId);
		$this->setIdVarejista($nIdVarejista);
		$this->setNmProduto($sNmProduto);
		$this->setDescProduto($sDescProduto);
		$this->setPreco($nPreco);
		$this->setImagem($sImagem);
		$this->setDtCriacao($dDtCriacao);
		$this->setPublicado($bPublicado);
		$this->setAtivo($bAtivo);
		
	}
	
}
?>