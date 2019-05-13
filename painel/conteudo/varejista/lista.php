<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");
require_once(PATH."/classes/Template.class.php");

$oFachadaConteudo = new FachadaConteudoBD();

$voVarejista = $oFachadaConteudo->recuperaTodosVarejista(BANCO);

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
$tpl->SUBMENULISTAVAREJISTASATIVO = "active";
$tpl->PAGINAATUAL = "Lista de Varejistas";

//RODAPE
require_once(PATH."painel/includes/rodape.php");

if(isset($voVarejista) && count($voVarejista) > 0){
	foreach($voVarejista as $oVarejista){
		if(isset($oVarejista) && is_object($oVarejista)){
				$tpl->IDVAREJISTA = $oVarejista->getId();
				$tpl->VAREJISTA = utf8_decode($oVarejista->getNmVarejista());
				$tpl->LOGOVAREJISTA = "http://placehold.it/400x400";
				if($oVarejista->getLogo() != ""){
					$tpl->LOGOVAREJISTA = "logo/".$oVarejista->getLogo();
				}

				$tpl->QTD_PRODUTOS = 0;
				$vWhereProduto = array("id_varejista = ".$oVarejista->getId());
				$voProduto = $oFachadaConteudo->recuperaTodosProduto(BANCO,$vWhereProduto);
				if(isset($voProduto) && count($voProduto) > 0){
					$tpl->QTD_PRODUTOS = count($voProduto);
				}
				
				$tpl->block("BLOCK_VAREJISTAS");
			
			
		}//if(isset($oProduto) && is_object($oProduto)){
	}//foreach($voProduto as $oProduto){
}//if(isset($voProduto) && count($voProduto) > 0){

$tpl->CAMINHO = CAMINHO;

$tpl->show();

?>