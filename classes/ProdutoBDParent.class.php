<?php
//á
require_once("Produto.class.php");
/**
* Classe responsável pelas interações com o banco de dados da entidade Produto
*/
class ProdutoBDParent {

var $oConexao;

	/**
	* Método responsável por construir Produto
	* @param $oConexao Conexão com o banco de dados. 
	* @access public
	*/
	/*
	function ProdutoBD($sBanco){
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
	* Método responsável por recuperar Produto
	* @param $nId nId
	
	* @access public
	* @return object Produto
	*/
	function recupera($nId) {
		$oConexao = $this->getConexao();
		$sSql = "select *						 
				 from   con_produto
		  		 where  id = '$nId'";
		$oConexao->execute($sSql);
		$oReg = $oConexao->fetchObject();
		if ($oReg) {
			$oProduto = new Produto($oReg->id,$oReg->id_varejista,utf8_encode($oConexao->unescapeString($oReg->nm_produto)),utf8_encode($oConexao->unescapeString($oReg->desc_produto)),$oReg->preco,utf8_encode($oConexao->unescapeString($oReg->imagem)),$oReg->dt_criacao,$oReg->publicado,$oReg->ativo);
			return $oProduto;
		}
		return false;
	}


	/**
	* Método responsável por verificar presença de Produto
	* @param $nId nId
	
	* @access public
	* @return boolean Indicando presença ou ausência de Produto
	*/
	function presente($nId){

		$oConexao = $this->getConexao();
		$sSql = "select id
				 from   con_produto
				 where  id = '$nId'
				";
		$oConexao->execute($sSql);
		if ($oConexao->getConsulta())
			return ($oConexao->recordCount() > 0);		
		return 0;
		
	}


	/**
	* Método responsável por inserir Produto
	* @param object $oProduto Objeto a ser inserido.
	* @access public
	* @return boolean Indicando sucesso ou não da operação;
	*/
	function insere($oProduto) {
		$oConexao = $this->getConexao();
		$sSql = "insert into con_produto (id_varejista,nm_produto,desc_produto,preco,imagem,dt_criacao,publicado,ativo) 
				 values ('".$oProduto->getIdVarejista()."','".utf8_decode($oConexao->escapeString($oProduto->getNmProduto()))."','".utf8_decode($oConexao->escapeString($oProduto->getDescProduto()))."','".$oProduto->getPreco()."','".utf8_decode($oConexao->escapeString($oProduto->getImagem()))."','".$oProduto->getDtCriacao()."','".$oProduto->getPublicado()."','".$oProduto->getAtivo()."')";		
		$oConexao->execute($sSql);		
		$nId = $oConexao->getLastId();
		if ($nId)
			return $nId;
		return $oConexao->getConsulta();
	}


	/**
	* Método responsável por alterar Produto
	* @param object $oProduto Objeto a ser alterado.
	* @access public
	* @return boolean Indicando presença ou ausência de Produto
	*/
	function altera($oProduto) {
		$oConexao = $this->getConexao();
		$sSql = "update con_produto 
				 set    id_varejista = '".$oProduto->getIdVarejista()."',
						nm_produto = '".utf8_decode($oConexao->escapeString($oProduto->getNmProduto()))."',
						desc_produto = '".utf8_decode($oConexao->escapeString($oProduto->getDescProduto()))."',
						preco = '".$oProduto->getPreco()."',
						imagem = '".utf8_decode($oConexao->escapeString($oProduto->getImagem()))."',
						dt_criacao = '".$oProduto->getDtCriacao()."',
						publicado = '".$oProduto->getPublicado()."',
						ativo = '".$oProduto->getAtivo()."'
				 where  id = '".$oProduto->getId()."' ";	
		$oConexao->execute($sSql);
		return $oConexao->getConsulta();
	}


	/**
	* Método responsável por recuperar todos os representantes da entidade Produto
	* @access public
	* @return array $voObjeto Vetor de objetos com os representantes de Produto
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
				 FROM con_produto
				 WHERE
				 ";
				 $sSql = substr($sSql.$sSql2,0,-5);
			}else{
				$sSql = "SELECT * 
				 FROM con_produto ";
			}
		}
		else {
			$sSql = "SELECT * 
				 FROM con_produto ";
		}

		if ($sOrder) {
			$sSql .= " ORDER BY ".$sOrder;
		}

		$oConexao->execute($sSql);
		$voObjeto = array();
		while ($oReg = $oConexao->fetchObject()) {
			$oProduto = new Produto($oReg->id,$oReg->id_varejista,utf8_encode($oConexao->unescapeString($oReg->nm_produto)),utf8_encode($oConexao->unescapeString($oReg->desc_produto)),$oReg->preco,utf8_encode($oConexao->unescapeString($oReg->imagem)),$oReg->dt_criacao,$oReg->publicado,$oReg->ativo);
			$voObjeto[] = $oProduto;
			unset($oProduto);
		}
		return $voObjeto;
	}


	/**
	* Método responsável por excluir Produto
	* @access public
	* @return boolean Indicando sucesso ou não da operação
	*/
	function exclui($nId) {
		$oConexao = $this->getConexao();
		$sSql = "delete from con_produto
				 where  id = '$nId' ";					
		$oConexao->execute($sSql);
		return $oConexao->getConsulta();
	}


	/**
	* Método responsável por desativar um registro da Produto
	* @access public
	* @return boolean Indicando sucesso ou não da operação
	*/
	function desativa($nId) {
		$oConexao = $this->getConexao();
		$sSql = "update con_produto
		 		 set ativo = '0'
				 where  id = '$nId' ";					
		$oConexao->execute($sSql);
		return $oConexao->getConsulta();
	}

}
?>