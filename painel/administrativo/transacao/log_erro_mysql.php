<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/Template.class.php");

// VERIFICA AS PERMISSÕES
$bPermissaoVisualizar = $_SESSION['oLoginAdm']->verificaPermissao("Transacao","VerErrosMySQL",BANCO);
$oFachadaSeguranca = new FachadaSegurancaBD();
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Transacao","VerErrosMySQL",BANCO);
if(!$bPermissaoVisualizar) {
	$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou acessar o log de erros de mysql do sistema, porém não possui permissão para isso!";
	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}else{
	$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." acessou o log de erros de mysql do sistema!";
	$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacao($oTransacao,BANCO);
}

$tpl = new Template('tpl/log_erro_mysql.html');

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
	$tpl->SUBMENUERROSMYSQLATIVO = "active";
	$tpl->PAGINAATUAL = "Log de Erros de MySQL";

	//RODAPE
	require_once(PATH."painel/includes/rodape.php");
}

$sUsuario = "SISTEMA";
$dDataHora = "";

$vWhereLogErroMysql = array("");
$sOrderLogErroMysql = "dt_erro desc, id asc";
$voLogErroMysql = $oFachadaSeguranca->recuperaTodosErrosMysql(BANCO,$vWhereLogErroMysql,$sOrderLogErroMysql);
if(isset($voLogErroMysql) && count($voLogErroMysql) > 0){
	foreach($voLogErroMysql as $oLogErroMysql){
		if(isset($oLogErroMysql) && is_object($oLogErroMysql)){
			if($oLogErroMysql->getIdUsuario() != "" && $oLogErroMysql->getIdUsuario() != "0"){
				$oUsuario = $oFachadaSeguranca->recuperaUsuario($oLogErroMysql->getIdUsuario(),BANCO);
				if(isset($oUsuario) && is_object($oUsuario))
					$sUsuario = $oUsuario->getNmUsuario();
			}
			
			$oDataHora = new Data(substr($oLogErroMysql->getDtErro(),0,10),"Y-m-d");
			$oDataHora->setFormato("d/m/Y");
			$dDataHora = $oDataHora->getData()." às ".substr($oLogErroMysql->getDtErro(),10);
			
			$tpl->IDLOGERROMYSQL = $oLogErroMysql->getId();
			$tpl->ERROMYSQL = utf8_decode($oLogErroMysql->getErro());
			$tpl->USUARIO = utf8_decode($sUsuario);
			$tpl->IP = $oLogErroMysql->getIp();
			$tpl->DATAHORA_ERROMYSQL = $dDataHora;
			$tpl->block("BLOCO_LOG_ERRO_MYSQL");
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