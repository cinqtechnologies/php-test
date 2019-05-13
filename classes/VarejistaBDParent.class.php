<?php
//á
require_once("Varejista.class.php");
/**
* Classe responsável pelas interações com o banco de dados da entidade Varejista
*/
class VarejistaBDParent {

var $oConexao;

	/**
	* Método responsável por construir Varejista
	* @param $oConexao Conexão com o banco de dados. 
	* @access public
	*/
	/*
	function VarejistaBD($sBanco){
		$this->oConexao = new Conexao($sBanco);
	}
	*/
	
	
	/**
	* Método responsável por atribuir valor ao atributo $oConexao
	* @param object $oConexao Conexão com o banco de dados.
	* @access public	
	*/
	function setConexao($oConexao){
		$this->oConexao = $oConexao;
	}
	
	
	/**
	* Método responsável recuperar o atributo $oConexao
	* @access public	
	* @return object $oConexao Conexão com o banco de dados.
	*/	
	function getConexao(){
		return $this->oConexao;
	}
	
	
	/**
	* Método responsável por recuperar Varejista
	* @param $nId nId
	
	* @access public
	* @return object Varejista
	*/
	function recupera($nId) {
		$oConexao = $this->getConexao();
		$sSql = "select *						 
				 from   con_varejista
		  		 where  id = '$nId'";
		$oConexao->execute($sSql);
		$oReg = $oConexao->fetchObject();
		if ($oReg) {
			$oVarejista = new Varejista($oReg->id,utf8_encode($oConexao->unescapeString($oReg->nm_varejista)),utf8_encode($oConexao->unescapeString($oReg->desc_varejista)),utf8_encode($oConexao->unescapeString($oReg->site)),utf8_encode($oConexao->unescapeString($oReg->logo)),$oReg->dt_criacao,$oReg->publicado,$oReg->ativo);
			return $oVarejista;
		}
		return false;
	}


	/**
	* Método responsável por verificar presença de Varejista
	* @param $nId nId
	
	* @access public
	* @return boolean Indicando presença ou ausência de Varejista
	*/
	function presente($nId){

		$oConexao = $this->getConexao();
		$sSql = "select id
				 from   con_varejista
				 where  id = '$nId'
				";
		$oConexao->execute($sSql);
		if ($oConexao->getConsulta())
			return ($oConexao->recordCount() > 0);		
		return 0;
		
	}


	/**
	* Método responsável por inserir Varejista
	* @param object $oVarejista Objeto a ser inserido.
	* @access public
	* @return boolean Indicando sucesso ou não da operação;
	*/
	function insere($oVarejista) {
		$oConexao = $this->getConexao();
		$sSql = "insert into con_varejista (nm_varejista,desc_varejista,site,logo,dt_criacao,publicado,ativo) 
				 values ('".utf8_decode($oConexao->escapeString($oVarejista->getNmVarejista()))."','".utf8_decode($oConexao->escapeString($oVarejista->getDescVarejista()))."','".utf8_decode($oConexao->escapeString($oVarejista->getSite()))."','".utf8_decode($oConexao->escapeString($oVarejista->getLogo()))."','".$oVarejista->getDtCriacao()."','".$oVarejista->getPublicado()."','".$oVarejista->getAtivo()."')";		
		$oConexao->execute($sSql);		
		$nId = $oConexao->getLastId();
		if ($nId)
			return $nId;
		return $oConexao->getConsulta();
	}


	/**
	* Método responsável por alterar Varejista
	* @param object $oVarejista Objeto a ser alterado.
	* @access public
	* @return boolean Indicando presença ou ausência de Varejista
	*/
	function altera($oVarejista) {
		$oConexao = $this->getConexao();
		$sSql = "update con_varejista 
				 set    nm_varejista = '".utf8_decode($oConexao->escapeString($oVarejista->getNmVarejista()))."',
						desc_varejista = '".utf8_decode($oConexao->escapeString($oVarejista->getDescVarejista()))."',
						site = '".utf8_decode($oConexao->escapeString($oVarejista->getSite()))."',
						logo = '".utf8_decode($oConexao->escapeString($oVarejista->getLogo()))."',
						dt_criacao = '".$oVarejista->getDtCriacao()."',
						publicado = '".$oVarejista->getPublicado()."',
						ativo = '".$oVarejista->getAtivo()."'
				 where  id = '".$oVarejista->getId()."' ";	
		$oConexao->execute($sSql);
		return $oConexao->getConsulta();
	}


	/**
	* Método responsável por recuperar todos os representantes da entidade Varejista
	* @access public
	* @return array $voObjeto Vetor de objetos com os representantes de Varejista
	*/
	function recuperaTodos($vWhere,$sOrder) {
		$oConexao = $this->getConexao();
		
		
		if (is_array($vWhere) && count($vWhere) > 0) {
			$sSql2 = "";
			foreach ($vWhere as $sWhere) {
				if($sWhere != "")
					$sSql2 .= $sWhere . " AND ";
			}
			if($sSql2 != ""){
				$sSql = "SELECT * 
				 FROM con_varejista
				 WHERE
				 ";
				 $sSql = substr($sSql.$sSql2,0,-5);
			}else{
				$sSql = "SELECT * 
				 FROM con_varejista ";
			}
		}
		else {
			$sSql = "SELECT * 
				 FROM con_varejista ";
		}

		if ($sOrder) {
			$sSql .= " ORDER BY ".$sOrder;
		}

		$oConexao->execute($sSql);
		$voObjeto = array();
		while ($oReg = $oConexao->fetchObject()) {
			$oVarejista = new Varejista($oReg->id,utf8_encode($oConexao->unescapeString($oReg->nm_varejista)),utf8_encode($oConexao->unescapeString($oReg->desc_varejista)),utf8_encode($oConexao->unescapeString($oReg->site)),utf8_encode($oConexao->unescapeString($oReg->logo)),$oReg->dt_criacao,$oReg->publicado,$oReg->ativo);
			$voObjeto[] = $oVarejista;
			unset($oVarejista);
		}
		return $voObjeto;
	}


	/**
	* Método responsável por excluir Varejista
	* @access public
	* @return boolean Indicando sucesso ou não da operação
	*/
	function exclui($nId) {
		$oConexao = $this->getConexao();
		$sSql = "delete from con_varejista
				 where  id = '$nId' ";					
		$oConexao->execute($sSql);
		return $oConexao->getConsulta();
	}


	/**
	* Método responsável por desativar um registro da Varejista
	* @access public
	* @return boolean Indicando sucesso ou não da operação
	*/
	function desativa($nId) {
		$oConexao = $this->getConexao();
		$sSql = "update con_varejista
		 		 set ativo = '0'
				 where  id = '$nId' ";					
		$oConexao->execute($sSql);
		return $oConexao->getConsulta();
	}

}
?>