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
$tpl->SUBMENULISTAVAREJISTASATIVO = "active";
$tpl->PAGINAATUAL = "Lista de Varejistas";

//RODAPE
require_once(PATH."painel/includes/rodape.php");

if(isset($_GET['nIdVarejista']) && $_GET['nIdVarejista'] != 0 && $_GET['nIdVarejista'] != ""){
	$nIdVarejista = $_GET['nIdVarejista'];
	$oVarejista = $oFachadaConteudo->recuperaVarejista($nIdVarejista,BANCO);
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

				foreach($voProduto as $oProduto){
					if(isset($oProduto) && is_object($oProduto)){
							$tpl->IDPRODUTO = $oProduto->getId();
							$tpl->PRODUTO = utf8_decode($oProduto->getNmProduto());
							$tpl->IMAGEMPRODUTO = "http://placehold.it/200x200";
							if($oProduto->getImagem() != ""){
								$tpl->IMAGEMPRODUTO = "../produto/imagem/".$oProduto->getImagem();
							}
							$tpl->PRECO = "R$ ".number_format($oProduto->getPreco(),2,',','.');
							
							$tpl->block("BLOCK_PRODUTOS");
						
						
					}//if(isset($oProduto) && is_object($oProduto)){
				}//foreach($voProduto as $oProduto){
			}

			$tpl->WEBSITE = $oVarejista->getSite();
			
			$tpl->DESCRICAO = utf8_decode($oVarejista->getDescVarejista());		
		
	}//if(isset($oProduto) && is_object($oProduto)){
}

$tpl->CAMINHO = CAMINHO;

$tpl->show();

?>