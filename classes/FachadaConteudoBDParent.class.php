<?php
//á
require_once("Conexao.class.php");
require_once("Produto.class.php");
require_once("ProdutoBD.class.php");
require_once("Varejista.class.php");
require_once("VarejistaBD.class.php");

require_once("FachadaSegurancaBD.class.php");

/**
* Classe responsável por todas as interações com o BD do sistema.
*/
class FachadaConteudoBDParent {

	/**
	* Método responsável por criar a Conexão.
	* @param $sBanco Nome do Banco de Dados
	* @return object $oConexao Conexão com o banco de dados especificado.
	*/
	function inicializaConexao($sBanco = ""){
		$oConexao = new Conexao($sBanco);
		return $oConexao;
	}
	
	
	/***á
	* Método responsável por instanciar um objeto de Produto
	* @access public
	* @return object $oProduto Produto
	*/	
	function inicializaProduto($nId,$nIdVarejista,$sNmProduto,$sDescProduto,$nPreco,$sImagem,$dDtCriacao,$bPublicado,$bAtivo) {
		$oProduto = new Produto($nId,$nIdVarejista,$sNmProduto,$sDescProduto,$nPreco,$sImagem,$dDtCriacao,$bPublicado,$bAtivo);
		return $oProduto;
	}


	/**
	* Método responsável por instanciar um objeto de ProdutoBD
	* @access public
	* @return object $oProdutoBD ProdutoBD
	*/	
	function inicializaProdutoBD($sBanco) {
		$oProdutoBD = new ProdutoBD($sBanco);
		return $oProdutoBD;
	}


	/** 
	* Método responsável por recuperar Produto
	* @param $nId nId
	* @access public
	* @return object $oProduto Produto
	*/
	function recuperaProduto($nId,$sBanco) {
		$oProdutoBD = $this->inicializaProdutoBD($sBanco);
 		$oProduto = $oProdutoBD->recupera($nId);
		return $oProduto;
	}


	/** 
	* Método responsável por recuperar todos os representantes da entidade Produto
	* @access public
	* @return array $aObjeto Vetor de objetos com os representantes de Produto
	*/
	function recuperaTodosProduto($sBanco,$vWhere=null,$vOrder=null) {
		$oProdutoBD = $this->inicializaProdutoBD($sBanco);
		$voObjeto = array();
		$voObjeto = $oProdutoBD->recuperaTodos($vWhere,$vOrder);
		return $voObjeto;
	}


	/** 
	* Método responsável por verificar presença de Produto
	* @param $nId nId
	* @access public
	* @return boolean $bResultado Indicando presença ou ausência de Produto
	*/
	function presenteProduto($nId,$sBanco){
		$oProdutoBD = $this->inicializaProdutoBD($sBanco);
 		$bResultado = $oProdutoBD->presente($nId);
		return $bResultado;
	}


	/** 
	* Método responsável por inserir Produto
	* @param object $oProduto Objeto a ser inserido.
	* @access public
	* @return boolean $bResultado Indicando sucesso ou não da operação;
	*/
	function insereProduto($oProduto,$oTransacao,$sBanco) {
		$oProdutoBD = $this->inicializaProdutoBD($sBanco);
 		$nId = $oProdutoBD->insere($oProduto);
		// INSERE TRANSAÇÃO 
		if($nId && is_object($oTransacao)) {
			$oFachadaSeguranca = new FachadaSegurancaBD();
			if(!$oFachadaSeguranca->insereTransacao($oTransacao,$sBanco))
				return false;
		}
		
		return $nId;
	}


	/** 
	* Método responsável por alterar Produto
	* @param object $oProduto Objeto a ser alterado.
	* @access public
	* @return boolean $bResultado Indicando presença ou ausência de Produto
	*/
	function alteraProduto($oProduto,$oTransacao,$sBanco) {
		$oProdutoBD = $this->inicializaProdutoBD($sBanco);
 		$bResultado = $oProdutoBD->altera($oProduto);
		// INSERE TRANSAÇÃO 
		if($bResultado && is_object($oTransacao)) {
			$oFachadaSeguranca = new FachadaSegurancaBD();
			if(!$oFachadaSeguranca->insereTransacao($oTransacao,$sBanco))
				return false;
		}
		
		return $bResultado;
	}


	/** 
	* Método responsável por excluir Produto
	* @access public
	* @return boolean $bResultado Indicando sucesso ou não da operação
	*/
	function excluiProduto($nId,$oTransacao,$sBanco) {
		$oProdutoBD = $this->inicializaProdutoBD($sBanco);
 		$bResultado = $oProdutoBD->exclui($nId);
		// INSERE TRANSAÇÃO 
		if($bResultado && is_object($oTransacao)) {
			$oFachadaSeguranca = new FachadaSegurancaBD();
			if(!$oFachadaSeguranca->insereTransacao($oTransacao,$sBanco))
				return false;
		}
		
		return $bResultado;
	}


	/** 
	* Método responsável por desativar um resgistro Produto
	* @access public
	* @return boolean $bResultado Indicando sucesso ou não da operação
	*/
	function desativaProduto($nId,$oTransacao,$sBanco) {
		$oProdutoBD = $this->inicializaProdutoBD($sBanco);
 		$bResultado = $oProdutoBD->desativa($nId);
		// INSERE TRANSAÇÃO 
		if($bResultado && is_object($oTransacao)) {
			$oFachadaSeguranca = new FachadaSegurancaBD();
			if(!$oFachadaSeguranca->insereTransacao($oTransacao,$sBanco))
				return false;
		}
		
		return $bResultado;
	}

	
	/***á
	* Método responsável por instanciar um objeto de Varejista
	* @access public
	* @return object $oVarejista Varejista
	*/	
	function inicializaVarejista($nId,$sNmVarejista,$sDescVarejista,$sSite,$sLogo,$dDtCriacao,$bPublicado,$bAtivo) {
		$oVarejista = new Varejista($nId,$sNmVarejista,$sDescVarejista,$sSite,$sLogo,$dDtCriacao,$bPublicado,$bAtivo);
		return $oVarejista;
	}


	/**
	* Método responsável por instanciar um objeto de VarejistaBD
	* @access public
	* @return object $oVarejistaBD VarejistaBD
	*/	
	function inicializaVarejistaBD($sBanco) {
		$oVarejistaBD = new VarejistaBD($sBanco);
		return $oVarejistaBD;
	}


	/** 
	* Método responsável por recuperar Varejista
	* @param $nId nId
	* @access public
	* @return object $oVarejista Varejista
	*/
	function recuperaVarejista($nId,$sBanco) {
		$oVarejistaBD = $this->inicializaVarejistaBD($sBanco);
 		$oVarejista = $oVarejistaBD->recupera($nId);
		return $oVarejista;
	}


	/** 
	* Método responsável por recuperar todos os representantes da entidade Varejista
	* @access public
	* @return array $aObjeto Vetor de objetos com os representantes de Varejista
	*/
	function recuperaTodosVarejista($sBanco,$vWhere=null,$vOrder=null) {
		$oVarejistaBD = $this->inicializaVarejistaBD($sBanco);
		$voObjeto = array();
		$voObjeto = $oVarejistaBD->recuperaTodos($vWhere,$vOrder);
		return $voObjeto;
	}


	/** 
	* Método responsável por verificar presença de Varejista
	* @param $nId nId
	* @access public
	* @return boolean $bResultado Indicando presença ou ausência de Varejista
	*/
	function presenteVarejista($nId,$sBanco){
		$oVarejistaBD = $this->inicializaVarejistaBD($sBanco);
 		$bResultado = $oVarejistaBD->presente($nId);
		return $bResultado;
	}


	/** 
	* Método responsável por inserir Varejista
	* @param object $oVarejista Objeto a ser inserido.
	* @access public
	* @return boolean $bResultado Indicando sucesso ou não da operação;
	*/
	function insereVarejista($oVarejista,$oTransacao,$sBanco) {
		$oVarejistaBD = $this->inicializaVarejistaBD($sBanco);
 		$nId = $oVarejistaBD->insere($oVarejista);
		// INSERE TRANSAÇÃO 
		if($nId && is_object($oTransacao)) {
			$oFachadaSeguranca = new FachadaSegurancaBD();
			if(!$oFachadaSeguranca->insereTransacao($oTransacao,$sBanco))
				return false;
		}
		
		return $nId;
	}


	/** 
	* Método responsável por alterar Varejista
	* @param object $oVarejista Objeto a ser alterado.
	* @access public
	* @return boolean $bResultado Indicando presença ou ausência de Varejista
	*/
	function alteraVarejista($oVarejista,$oTransacao,$sBanco) {
		$oVarejistaBD = $this->inicializaVarejistaBD($sBanco);
 		$bResultado = $oVarejistaBD->altera($oVarejista);
		// INSERE TRANSAÇÃO 
		if($bResultado && is_object($oTransacao)) {
			$oFachadaSeguranca = new FachadaSegurancaBD();
			if(!$oFachadaSeguranca->insereTransacao($oTransacao,$sBanco))
				return false;
		}
		
		return $bResultado;
	}


	/** 
	* Método responsável por excluir Varejista
	* @access public
	* @return boolean $bResultado Indicando sucesso ou não da operação
	*/
	function excluiVarejista($nId,$oTransacao,$sBanco) {
		$oVarejistaBD = $this->inicializaVarejistaBD($sBanco);
 		$bResultado = $oVarejistaBD->exclui($nId);
		// INSERE TRANSAÇÃO 
		if($bResultado && is_object($oTransacao)) {
			$oFachadaSeguranca = new FachadaSegurancaBD();
			if(!$oFachadaSeguranca->insereTransacao($oTransacao,$sBanco))
				return false;
		}
		
		return $bResultado;
	}


	/** 
	* Método responsável por desativar um resgistro Varejista
	* @access public
	* @return boolean $bResultado Indicando sucesso ou não da operação
	*/
	function desativaVarejista($nId,$oTransacao,$sBanco) {
		$oVarejistaBD = $this->inicializaVarejistaBD($sBanco);
 		$bResultado = $oVarejistaBD->desativa($nId);
		// INSERE TRANSAÇÃO 
		if($bResultado && is_object($oTransacao)) {
			$oFachadaSeguranca = new FachadaSegurancaBD();
			if(!$oFachadaSeguranca->insereTransacao($oTransacao,$sBanco))
				return false;
		}
		
		return $bResultado;
	}

}
?>