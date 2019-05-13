<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/Template.class.php");

$nIdUsuario = (isset($_SESSION['oLoginAdm']) && $_SESSION['oLoginAdm']->getIdUsuario() != "") ? $_SESSION['oLoginAdm']->getIdUsuario() : "";
$sOP = ($nIdUsuario != "") ? "AlterarSenha" : "";
$oFachadaSeguranca = new FachadaSegurancaBD();

if(isset($nIdUsuario) && $nIdUsuario != "" && $nIdUsuario != 0) {
	$oUsuarioAcesso = $oFachadaSeguranca->recuperaUsuario($nIdUsuario,BANCO);
	if(is_object($oUsuarioAcesso)){
		$sNmUsuarioAcesso = $oUsuarioAcesso->getNmUsuario();
	}//if(is_object($oUsuarioAcesso)){
}//if(isset($nIdUsuario) && $nIdUsuario != "" && $nIdUsuario != 0) {

$bPermissao = $_SESSION['oLoginAdm']->verificaPermissao("Usuario",$sOP,BANCO);
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Usuario",$sOP,BANCO);
if(!$bPermissao) {
	if(isset($nIdUsuario) && $nIdUsuario != "" && $nIdUsuario != 0) {
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar suas informações, porém não possui permissão para isso!";
	}else{
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar informações na gerência de usuários, entretanto o id do usuário não foi carregado corretamente, a informação de id carregada no sistema foi o id:".$nIdUsuario.". De qualquer forma este usuário não possui permissão para alterar informações na gerência de usuários!";
	}//if(isset($nIdUsuario) && $nIdUsuario != "" && $nIdUsuario != 0) {
	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}else{
	$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." acessou o sistema para alterar suas informações";
	$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacao($oTransacao,BANCO);
}//if(!$bPermissao) {

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
	$tpl->MENUADMATIVO = "active";
	$tpl->SUBMENUALTERASENHAATIVO = "active";
	$tpl->PAGINAATUAL = "Alterar Dados";

	//RODAPE
	require_once(PATH."painel/includes/rodape.php");
}

$voGrupoUsuario = $oFachadaSeguranca->recuperaTodosGrupoUsuario(BANCO);

$tpl->ACAO = $sOP;
if(isset($nIdUsuario) && $nIdUsuario != "" && $nIdUsuario != 0){
	$oUsuarioDetalhe = $oFachadaSeguranca->recuperaUsuario($nIdUsuario,BANCO);
	if(isset($oUsuarioDetalhe) && is_object($oUsuarioDetalhe)){
		$tpl->LOGADO = $oUsuarioDetalhe->getLogado();
		$tpl->DATACADASTRO = $oUsuarioDetalhe->getDtUsuario();
		$tpl->IDUSUARIO = $oUsuarioDetalhe->getId();
		$tpl->NOME = utf8_decode($oUsuarioDetalhe->getNmUsuario());
		$tpl->EMAIL = $oUsuarioDetalhe->getEmail();
		$tpl->IDGRUPOUSUARIO = $oUsuarioDetalhe->getIdGrupoUsuario();
		$tpl->GRUPOUSUARIO = "";
		$oGrupoUsuario = $oFachadaSeguranca->recuperaGrupoUsuario($oUsuarioDetalhe->getIdGrupoUsuario(),BANCO);
		if(isset($oGrupoUsuario) && is_object($oGrupoUsuario))
			$tpl->GRUPOUSUARIO = $oGrupoUsuario->getNmGrupoUsuario();
		$tpl->LOGIN = $oUsuarioDetalhe->getLogin();
	}//if(isset($oUsuarioDetalhe) && is_object($oUsuarioDetalhe)){
}else{
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
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