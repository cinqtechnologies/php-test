<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");
require_once(PATH."/classes/Template.class.php");

// VERIFICA AS PERMISSÕES
$bPermissaoVisualizar = $_SESSION['oLoginAdm']->verificaPermissao("Produto","Visualizar",BANCO);
$oFachadaSeguranca = new FachadaSegurancaBD();
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Produto","Visualizar",BANCO);
if(!$bPermissaoVisualizar) {
	$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou acessar a lista de produtos do sistema, porém não possui permissão para isso!";
	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}else{
	$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." acessou a lista de produtos do sistema!";
	$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacao($oTransacao,BANCO);
}

$oFachadaConteudo = new FachadaConteudoBD();

$voProduto = $oFachadaConteudo->recuperaTodosProduto(BANCO);

$tpl = new Template('tpl/index.html');

$tpl->addFile('HEAD','../../includes/head.html');
$tpl->addFile('TOPO_PAINEL','../../includes/topo_painel.html');
$tpl->addFile('MENU_LATERAL','../../includes/menu_lateral.html');
$tpl->addFile('SCRIPTJS','../../includes/scriptsjs.html');
$tpl->addFile('RODAPE','../../includes/rodape.html');
$tpl->USUARIOLOGADO = utf8_decode($_SESSION['oLoginAdm']->getUsuario()->getNmUsuario());

if(is_object($_SESSION['oLoginAdm']->oUsuario)){
	$tpl->MENSAGEM = "";
	$tpl->TIPOALERTAMENSAGEM = "";
	if(isset($_SESSION['sMsgPermissao']) && $_SESSION['sMsgPermissao'] != ""){
		$tpl->TIPOALERTAMENSAGEM = "danger"; //danger info warning success
		$tpl->MENSAGEM = $_SESSION['sMsgPermissao'];
		$tpl->block("BLOCO_MENSAGEM");
	}
	
	if(isset($_SESSION['sMsg']) && $_SESSION['sMsg'] != ""){
		$tpl->TIPOALERTAMENSAGEM = "success";
		if(isset($_GET['bErro']) && $_GET['bErro'] == 1)
			$tpl->TIPOALERTAMENSAGEM = "danger";
		$tpl->MENSAGEM = $_SESSION['sMsg'];
		$tpl->block("BLOCO_MENSAGEM");
	}
	
	//MENU
	require_once(PATH."painel/includes/menu_lateral.php");
	$tpl->MENUCONTEUDOATIVO = "active";
	$tpl->SUBMENUPRODUTOATIVO = "active";
	$tpl->PAGINAATUAL = "Gerência de Produtos";

	//RODAPE
	require_once(PATH."painel/includes/rodape.php");
}

if(isset($voProduto) && count($voProduto) > 0){
	foreach($voProduto as $oProduto){
		if(isset($oProduto) && is_object($oProduto)){
			$oDataCriacao = new Data(substr($oProduto->getDtCriacao(),0,10),"Y-m-d");
			$oDataCriacao->setFormato("d/m/Y");
			$dDataCriacao = $oDataCriacao->getData()." às ".substr($oProduto->getDtCriacao(),10);
			
			$tpl->IDPRODUTO = $oProduto->getId();
			$tpl->NOME = utf8_decode($oProduto->getNmProduto());

			$tpl->VAREJISTA = "";
			$oVarejista = $oFachadaConteudo->recuperaVarejista($oProduto->getIdVarejista(),BANCO);
			if(isset($oVarejista) && is_object($oVarejista)){
				$tpl->VAREJISTA = utf8_decode($oVarejista->getNmVarejista());
			}

			$tpl->PRECO = "R$ ".number_format($oProduto->getPreco(),2,',','.');
			$tpl->DATA_CRIACAO = $dDataCriacao;
			$tpl->PUBLICADO = ($oProduto->getPublicado() == 1) ? "<img id='".$oProduto->getId()."' class='publicar' src='{CAMINHO}images/publicar.gif'>" : "<img id='".$oProduto->getId()."' class='despublicar' src='{CAMINHO}images/despublicar.gif'>";
			$tpl->ATIVO = ($oProduto->getAtivo() == 1) ? "<img id='".$oProduto->getId()."' class='ativar' src='{CAMINHO}images/publicar.gif'>" : "<img id='".$oProduto->getId()."' class='desativar' src='{CAMINHO}images/despublicar.gif'>";
			
			$tpl->block("BLOCO_PRODUTOS");
			
		}//if(isset($oUsuario) && is_object($oUsuario)){
	}//foreach($voUsuario as $oUsuario){
}//if(isset($voUsuario) && count($voUsuario) > 0){

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