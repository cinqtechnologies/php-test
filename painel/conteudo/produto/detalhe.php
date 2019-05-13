<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");
require_once(PATH."/classes/Template.class.php");

$oFachadaConteudo = new FachadaConteudoBD();

$tpl = new Template('tpl/detalhe.html');

$tpl->addFile('HEAD','../../includes/head.html');
$tpl->addFile('TOPO_PAINEL','../../includes/topo_painel.html');
$tpl->addFile('MENU_LATERAL','../../includes/menu_lateral.html');
$tpl->addFile('SCRIPTJS','../../includes/scriptsjs.html');
$tpl->addFile('RODAPE','../../includes/rodape.html');
$tpl->USUARIOLOGADO = utf8_decode($_SESSION['oLoginAdm']->getUsuario()->getNmUsuario());

//MENU
require_once(PATH."painel/includes/menu_lateral.php");
$tpl->MENULISTAATIVO = "active";
$tpl->SUBMENULISTAPRODUTOSATIVO = "active";
$tpl->PAGINAATUAL = "Detalhe do Produto";

//RODAPE
require_once(PATH."painel/includes/rodape.php");

if(isset($_GET['nIdProduto']) && $_GET['nIdProduto'] != 0 && $_GET['nIdProduto'] != ""){
	$nIdProduto = $_GET['nIdProduto'];
	$oProduto = $oFachadaConteudo->recuperaProduto($nIdProduto,BANCO);
	if(isset($oProduto) && is_object($oProduto)){
		$tpl->IDPRODUTO = $oProduto->getId();
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

if(isset($_SESSION['oUsuario']))
	unset($_SESSION['oUsuario']);
unset($_POST);
if(isset($_SESSION['sMsg'])){
	$_SESSION['sMsg'] = "";
	unset($_SESSION['sMsg']);
}
if(isset($_SESSION['sMsgPermissao'])){
	$_SESSION['sMsgPermissao'] = "";
	unset($_SESSION['sMsgPermissao']);
}

$tpl->show();

?>