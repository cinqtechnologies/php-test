<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/Template.class.php");

// VERIFICA AS PERMISSÕES
$bPermissaoVisualizar = $_SESSION['oLoginAdm']->verificaPermissao("Transacao","VerErro",BANCO);
$oFachadaSeguranca = new FachadaSegurancaBD();
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Transacao","VerErro",BANCO);
if(!$bPermissaoVisualizar) {
	$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou acessar o log de erros do sistema, porém não possui permissão para isso!";
	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}else{
	$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." acessou o log de erros do sistema!";
	$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacao($oTransacao,BANCO);
}

$tpl = new Template('tpl/log_erros.html');

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
	$tpl->MENUADMATIVO = "active";
	$tpl->SUBMENUERROSATIVO = "active";
	$tpl->PAGINAATUAL = "Log de Erros";

	//RODAPE
	require_once(PATH."painel/includes/rodape.php");
}

$sUsuario = "SISTEMA";
$sArea = "";
$sAcao = "";
$dDataHora = "";

$vWhereTransacao = array("publicado = 1","ativo = 1");
$sOrderTransacao = "dt_transacao desc, id asc";
$voTransacao = $oFachadaSeguranca->recuperaTodosTransacaoAcesso(BANCO,$vWhereTransacao,$sOrderTransacao);
if(isset($voTransacao) && count($voTransacao) > 0){
	foreach($voTransacao as $oTransacao){
		if(isset($oTransacao) && is_object($oTransacao)){
			if($oTransacao->getIdUsuario() != "" && $oTransacao->getIdUsuario() != "0"){
				$oUsuario = $oFachadaSeguranca->recuperaUsuario($oTransacao->getIdUsuario(),BANCO);
				if(isset($oUsuario) && is_object($oUsuario))
					$sUsuario = $oUsuario->getNmUsuario();
			}
				
			$oAcao = $oFachadaSeguranca->recuperaTipoTransacao($oTransacao->getIdTipoTransacao(),BANCO);
			if(isset($oAcao) && is_object($oAcao)){
				$sAcao = $oAcao->getTransacao();
				$oArea = $oFachadaSeguranca->recuperaCategoriaTipoTransacao($oAcao->getIdCategoriaTipoTransacao(),BANCO);
				if(isset($oArea) && is_object($oArea))
					$sArea = $oArea->getDescricao();
			}
			
			$oDataHora = new Data(substr($oTransacao->getDtTransacao(),0,10),"Y-m-d");
			$oDataHora->setFormato("d/m/Y");
			$dDataHora = $oDataHora->getData()." às ".substr($oTransacao->getDtTransacao(),10);
			
			$tpl->IDLOG = $oTransacao->getId();
			$tpl->USUARIO = utf8_decode($sUsuario);
			$tpl->AREA = utf8_decode($sArea);
			$tpl->ACAO = utf8_decode($sAcao);
			$tpl->LOG = utf8_decode($oTransacao->getObjeto());
			$tpl->DATAHORA = $dDataHora;
			$tpl->block("BLOCO_LOG_ERROS");
		}
	}
}

$tpl->CAMINHO = CAMINHO;

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