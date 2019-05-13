<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");
require_once(PATH."/classes/Template.class.php");

// VERIFICA AS PERMISSÕES
$bPermissaoVisualizar = $_SESSION['oLoginAdm']->verificaPermissao("Varejista","Visualizar",BANCO);
$oFachadaSeguranca = new FachadaSegurancaBD();
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Varejista","Visualizar",BANCO);
if(!$bPermissaoVisualizar) {
	$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou acessar a lista de varejistas do sistema, porém não possui permissão para isso!";
	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}else{
	$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." acessou a lista de varejistas do sistema!";
	$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacao($oTransacao,BANCO);
}

$oFachadaConteudo = new FachadaConteudoBD();

$voVarejista = $oFachadaConteudo->recuperaTodosVarejista(BANCO);

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
	$tpl->SUBMENUVAREJISTAATIVO = "active";
	$tpl->PAGINAATUAL = "Gerência de Varejistas";

	//RODAPE
	require_once(PATH."painel/includes/rodape.php");
}

if(isset($voVarejista) && count($voVarejista) > 0){
	foreach($voVarejista as $oVarejista){
		if(isset($oVarejista) && is_object($oVarejista)){
			$oDataCriacao = new Data(substr($oVarejista->getDtCriacao(),0,10),"Y-m-d");
			$oDataCriacao->setFormato("d/m/Y");
			$dDataCriacao = $oDataCriacao->getData()." às ".substr($oVarejista->getDtCriacao(),10);
			
			$tpl->IDVAREJISTA = $oVarejista->getId();
			$tpl->NOME = utf8_decode($oVarejista->getNmVarejista());
			$tpl->LOGO = "<img src='logo/".$oVarejista->getLogo()."' width='40px' height='40px' />";
			$tpl->WEBSITE = $oVarejista->getSite();
			$tpl->DATA_CRIACAO = $dDataCriacao;
			$tpl->PUBLICADO = ($oVarejista->getPublicado() == 1) ? "<img id='".$oVarejista->getId()."' class='publicar' src='{CAMINHO}images/publicar.gif'>" : "<img id='".$oVarejista->getId()."' class='despublicar' src='{CAMINHO}images/despublicar.gif'>";
			$tpl->ATIVO = ($oVarejista->getAtivo() == 1) ? "<img id='".$oVarejista->getId()."' class='ativar' src='{CAMINHO}images/publicar.gif'>" : "<img id='".$oVarejista->getId()."' class='desativar' src='{CAMINHO}images/despublicar.gif'>";
			
			$tpl->block("BLOCO_VAREJISTAS");
			
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