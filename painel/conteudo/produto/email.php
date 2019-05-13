<?php
require_once("../../../constantes.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");
require_once(PATH."/classes/Template.class.php");

$oFachadaConteudo = new FachadaConteudoBD();

$tpl = new Template('tpl/email.html');

$tpl->addFile('HEAD','../../includes/head.html');

if(isset($_POST['fIdProduto']) && $_POST['fIdProduto'] != 0 && $_POST['fIdProduto'] != ""){
	$nIdProduto = $_POST['fIdProduto'];
	$oProduto = $oFachadaConteudo->recuperaProduto($nIdProduto,BANCO);
	if(isset($oProduto) && is_object($oProduto)){
		//$tpl->IDPRODUTO = $oProduto->getId();
		$tpl->PRODUTO = utf8_decode($oProduto->getNmProduto());
		$tpl->IMAGEMPRODUTO = "http://placehold.it/400x400";
		if($oProduto->getImagem() != ""){
			$tpl->IMAGEMPRODUTO = "imagem/".$oProduto->getImagem();
		}
		$tpl->DESCRICAO = utf8_decode($oProduto->getDescProduto());
		$tpl->PRECO = "R$ ".number_format($oProduto->getPreco(),2,',','.');
		$tpl->VAREJISTA = "";
		$oVarejista = $oFachadaConteudo->recuperaVarejista($oProduto->getIdVarejista(),BANCO);
		if(isset($oVarejista) && is_object($oVarejista)){
			$tpl->IDVAREJISTA = $oVarejista->getId();
			$tpl->VAREJISTA = utf8_decode($oVarejista->getNmVarejista());
		}
	}//if(isset($oProduto) && is_object($oProduto)){
}

$tpl->CAMINHO = CAMINHO;

$tpl->show();

?>