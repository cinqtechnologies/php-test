<?php
//á
class VarejistaParent {

/**
* nId
* @access private
*/
var $nId;
/**
* sNmVarejista
* @access private
*/
var $sNmVarejista;
/**
* sDescVarejista
* @access private
*/
var $sDescVarejista;
/**
* sSite
* @access private
*/
var $sSite;
/**
* sLogo
* @access private
*/
var $sLogo;
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
	
	/*
	function Varejista($nId,$sNmVarejista,$sDescVarejista,$sSite,$sLogo,$dDtCriacao,$bPublicado,$bAtivo){
		$this->setId($nId);
		$this->setNmVarejista($sNmVarejista);
		$this->setDescVarejista($sDescVarejista);
		$this->setSite($sSite);
		$this->setLogo($sLogo);
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
	* Recupera o valor do atributo $sNmVarejista. 
	* @return $sNmVarejista NmVarejista
	*/
	function getNmVarejista(){
		return $this->sNmVarejista;
	}
	/**
	* Atribui valor ao atributo $sNmVarejista. 
	* @param $sNmVarejista NmVarejista
	* @access public
	*/
	function setNmVarejista($sNmVarejista){
		$this->sNmVarejista = $sNmVarejista;
	}

	/**
	* Recupera o valor do atributo $sDescVarejista. 
	* @return $sDescVarejista DescVarejista
	*/
	function getDescVarejista(){
		return $this->sDescVarejista;
	}
	/**
	* Atribui valor ao atributo $sDescVarejista. 
	* @param $sDescVarejista DescVarejista
	* @access public
	*/
	function setDescVarejista($sDescVarejista){
		$this->sDescVarejista = $sDescVarejista;
	}

	/**
	* Recupera o valor do atributo $sSite. 
	* @return $sSite Site
	*/
	function getSite(){
		return $this->sSite;
	}
	/**
	* Atribui valor ao atributo $sSite. 
	* @param $sSite Site
	* @access public
	*/
	function setSite($sSite){
		$this->sSite = $sSite;
	}

	/**
	* Recupera o valor do atributo $sLogo. 
	* @return $sLogo Logo
	*/
	function getLogo(){
		return $this->sLogo;
	}
	/**
	* Atribui valor ao atributo $sLogo. 
	* @param $sLogo Logo
	* @access public
	*/
	function setLogo($sLogo){
		$this->sLogo = $sLogo;
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