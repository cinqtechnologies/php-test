<?php
//á
class ProdutoParent {

/**
* nId
* @access private
*/
var $nId;
/**
* nIdVarejista
* @access private
*/
var $nIdVarejista;
/**
* sNmProduto
* @access private
*/
var $sNmProduto;
/**
* sDescProduto
* @access private
*/
var $sDescProduto;
/**
* nPreco
* @access private
*/
var $nPreco;
/**
* sImagem
* @access private
*/
var $sImagem;
/**
* dDtCriacao
* @access private
*/
var $dDtCriacao;
/**
* bPublicado
* @access private
*/
var $bPublicado;
/**
* bAtivo
* @access private
*/
var $bAtivo;

	
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
	
	/*
	function Produto($nId,$nIdVarejista,$sNmProduto,$sDescProduto,$nPreco,$sImagem,$dDtCriacao,$bPublicado,$bAtivo){
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
	*/
	
	/**
	* Recupera o valor do atributo $nId. 
	* @return $nId Id
	*/
	function getId(){
		return $this->nId;
	}
	/**
	* Atribui valor ao atributo $nId. 
	* @param $nId Id
	* @access public
	*/
	function setId($nId){
		$this->nId = $nId;
	}

	/**
	* Recupera o valor do atributo $nIdVarejista. 
	* @return $nIdVarejista IdVarejista
	*/
	function getIdVarejista(){
		return $this->nIdVarejista;
	}
	/**
	* Atribui valor ao atributo $nIdVarejista. 
	* @param $nIdVarejista IdVarejista
	* @access public
	*/
	function setIdVarejista($nIdVarejista){
		$this->nIdVarejista = $nIdVarejista;
	}

	/**
	* Recupera o valor do atributo $sNmProduto. 
	* @return $sNmProduto NmProduto
	*/
	function getNmProduto(){
		return $this->sNmProduto;
	}
	/**
	* Atribui valor ao atributo $sNmProduto. 
	* @param $sNmProduto NmProduto
	* @access public
	*/
	function setNmProduto($sNmProduto){
		$this->sNmProduto = $sNmProduto;
	}

	/**
	* Recupera o valor do atributo $sDescProduto. 
	* @return $sDescProduto DescProduto
	*/
	function getDescProduto(){
		return $this->sDescProduto;
	}
	/**
	* Atribui valor ao atributo $sDescProduto. 
	* @param $sDescProduto DescProduto
	* @access public
	*/
	function setDescProduto($sDescProduto){
		$this->sDescProduto = $sDescProduto;
	}

	/**
	* Recupera o valor do atributo $nPreco. 
	* @return $nPreco Preco
	*/
	function getPreco(){
		return $this->nPreco;
	}
	/**
	* Atribui valor ao atributo $nPreco. 
	* @param $nPreco Preco
	* @access public
	*/
	function setPreco($nPreco){
		$this->nPreco = $nPreco;
	}

	/**
	* Recupera o valor do atributo $sImagem. 
	* @return $sImagem Imagem
	*/
	function getImagem(){
		return $this->sImagem;
	}
	/**
	* Atribui valor ao atributo $sImagem. 
	* @param $sImagem Imagem
	* @access public
	*/
	function setImagem($sImagem){
		$this->sImagem = $sImagem;
	}

	/**
	* Recupera o valor do atributo $dDtCriacao. 
	* @return $dDtCriacao DtCriacao
	*/
	function getDtCriacao(){
		return $this->dDtCriacao;
	}
	/**
	* Atribui valor ao atributo $dDtCriacao. 
	* @param $dDtCriacao DtCriacao
	* @access public
	*/
	function setDtCriacao($dDtCriacao){
		$this->dDtCriacao = $dDtCriacao;
	}

	/**
	* Recupera o valor do atributo $bPublicado. 
	* @return $bPublicado Publicado
	*/
	function getPublicado(){
		return $this->bPublicado;
	}
	/**
	* Atribui valor ao atributo $bPublicado. 
	* @param $bPublicado Publicado
	* @access public
	*/
	function setPublicado($bPublicado){
		$this->bPublicado = $bPublicado;
	}

	/**
	* Recupera o valor do atributo $bAtivo. 
	* @return $bAtivo Ativo
	*/
	function getAtivo(){
		return $this->bAtivo;
	}
	/**
	* Atribui valor ao atributo $bAtivo. 
	* @param $bAtivo Ativo
	* @access public
	*/
	function setAtivo($bAtivo){
		$this->bAtivo = $bAtivo;
	}

	
}
?>