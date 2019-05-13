<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");
require_once(PATH."/classes/Template.class.php");

$oFachadaConteudo = new FachadaConteudoBD();

$voProduto = $oFachadaConteudo->recuperaTodosProduto(BANCO);

$tpl = new Template('tpl/lista.html');

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
$tpl->PAGINAATUAL = "Lista de Produtos";

//RODAPE
require_once(PATH."painel/includes/rodape.php");

if(isset($voProduto) && count($voProduto) > 0){
	foreach($voProduto as $oProduto){
		if(isset($oProduto) && is_object($oProduto)){
				$tpl->IDPRODUTO = $oProduto->getId();
				$tpl->PRODUTO = utf8_decode($oProduto->getNmProduto());
				$tpl->IMAGEMPRODUTO = "http://placehold.it/200x200";
				if($oProduto->getImagem() != ""){
					$tpl->IMAGEMPRODUTO = "imagem/".$oProduto->getImagem();
				}
				$tpl->PRECO = "R$ ".number_format($oProduto->getPreco(),2,',','.');
				$tpl->VAREJISTA = "";
				$oVarejista = $oFachadaConteudo->recuperaVarejista($oProduto->getIdVarejista(),BANCO);
				if(isset($oVarejista) && is_object($oVarejista)){
					$tpl->IDVAREJISTA = $oVarejista->getId();
					$tpl->VAREJISTA = utf8_decode($oVarejista->getNmVarejista());
				}
				
				$tpl->block("BLOCK_PRODUTOS");
			
			
		}//if(isset($oProduto) && is_object($oProduto)){
	}//foreach($voProduto as $oProduto){
}//if(isset($voProduto) && count($voProduto) > 0){

$tpl->CAMINHO = CAMINHO;


$tpl->show();

?>