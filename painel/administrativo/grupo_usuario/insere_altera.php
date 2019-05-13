<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/Template.class.php");

$nIdGrupoUsuario = (isset($_GET['nIdGrupoUsuario']) && $_GET['nIdGrupoUsuario'] != "" && $_GET['nIdGrupoUsuario'] != 0) ? $_GET['nIdGrupoUsuario'] : ((isset($_POST['fIdGrupoUsuario'][0]) && $_POST['fIdGrupoUsuario'][0] != "" && $_POST['fIdGrupoUsuario'][0] != 0) ? $_POST['fIdGrupoUsuario'][0] : "");
$sOP = ($nIdGrupoUsuario) ? "Alterar" : "Cadastrar"; 

$oFachadaSeguranca = new FachadaSegurancaBD();

if(isset($nIdGrupoUsuario) && $nIdGrupoUsuario != "" && $nIdGrupoUsuario != 0) {
	$oGrupoUsuarioAcesso = $oFachadaSeguranca->recuperaGrupoUsuario($nIdGrupoUsuario,BANCO);
	if(is_object($oGrupoUsuarioAcesso)){
		$sNmGrupoUsuarioAcesso = $oGrupoUsuarioAcesso->getNmGrupoUsuario();
	}//if(is_object($oUsuarioAcesso)){
}//if(isset($nIdGrupoUsuario) && $nIdGrupoUsuario != "" && $nIdGrupoUsuario != 0) {

$bPermissao = $_SESSION['oLoginAdm']->verificaPermissao("Grupos",$sOP,BANCO);
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Grupos",$sOP,BANCO);
if(!$bPermissao) {
	if($sOP == "Cadastrar"){
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou cadastrar informações na gerência de grupos de usuários, porém não possui permissão para isso!";
	}else{
		if(isset($nIdGrupoUsuario) && $nIdGrupoUsuario != "" && $nIdGrupoUsuario != 0) {
			$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar dados do grupo de usuários ".utf8_decode($sNmGrupoUsuarioAcesso)." de id: ".$nIdGrupoUsuario.", porém não possui permissão para isso!";
		}else{
			$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar informações na gerência de grupos de usuários, entretanto o id do grupo de usuários não foi carregado corretamente, a informação de id carregada no sistema foi o id:".$nIdGrupoUsuario.". De qualquer forma este usuário não possui permissão para alterar informações na gerência de grupos de usuários!";
		}//if(isset($nIdUsuario) && $nIdUsuario != "" && $nIdUsuario != 0) {
	}//if($sOP == "Cadastrar"){
	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}else{
	$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." acessou a gerência de grupos de usuários para ".utf8_decode($sOP)." informações";
	if($sOP == "Alterar")
		$sObjeto .= " do Grupo de Usuários ".utf8_decode($sNmGrupoUsuarioAcesso)." de Id: ".$nIdGrupoUsuario;
	$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacao($oTransacao,BANCO);
}//if(!$bPermissao) {

$tpl = new Template('tpl/insere_altera.html');

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
	$tpl->SUBMENUGRUPOUSUARIOSATIVO = "active";
	$tpl->PAGINAATUAL = "Cadastro de Grupo de Usuários";

	//RODAPE
	require_once(PATH."painel/includes/rodape.php");
}

$tpl->ACAO = $sOP;
$tpl->DATACADASTRO = date("Y-m-d H:i:s");
if(isset($nIdGrupoUsuario) && $nIdGrupoUsuario != "" && $nIdGrupoUsuario != 0){
	$oGrupoUsuario = $oFachadaSeguranca->recuperaGrupoUsuario($nIdGrupoUsuario,BANCO);
	if(isset($oGrupoUsuario) && is_object($oGrupoUsuario)){
		$tpl->DATACADASTRO = $oGrupoUsuario->getDtGrupoUsuario();
		$tpl->IDGRUPOUSUARIO = $oGrupoUsuario->getId();
		$tpl->GRUPO = utf8_decode($oGrupoUsuario->getNmGrupoUsuario());
		$tpl->CHECKEDPUBLICADO = ($oGrupoUsuario->getPublicado() == 1) ? "checked" : "";
		$tpl->CHECKEDATIVO = ($oGrupoUsuario->getAtivo() == 1) ? "checked" : "";
	}//if(isset($oGrupoUsuario) && is_object($oGrupoUsuario)){
}

$tpl->CAMINHO = CAMINHO;

if(isset($_SESSION['oGrupoUsuario']))
	unset($_SESSION['oGrupoUsuario']);
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