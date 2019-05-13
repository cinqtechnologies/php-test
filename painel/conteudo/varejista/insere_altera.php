<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");
require_once(PATH."/classes/Template.class.php");

$nIdVarejista = (isset($_GET['nIdVarejista']) && $_GET['nIdVarejista'] != "" && $_GET['nIdVarejista'] != 0) ? $_GET['nIdVarejista'] : ((isset($_POST['fIdVarejista'][0]) && $_POST['fIdVarejista'][0] != "" && $_POST['fIdVarejista'][0] != 0) ? $_POST['fIdVarejista'][0] : "");
$sOP = ($nIdVarejista != "") ? "Alterar" : "Cadastrar"; 
$oFachadaSeguranca = new FachadaSegurancaBD();
$oFachadaConteudo = new FachadaConteudoBD();

if(isset($nIdVarejista) && $nIdVarejista != "" && $nIdVarejista != 0) {
	$oVarejistaAcesso = $oFachadaConteudo->recuperaVarejista($nIdVarejista,BANCO);
	if(is_object($oVarejistaAcesso)){
		$sNmVarejistaAcesso = $oVarejistaAcesso->getNmVarejista();
	}//if(is_object($oVarejistaAcesso)){
}//if(isset($nIdVarejista) && $nIdVarejista != "" && $nIdVarejista != 0) {

$bPermissao = $_SESSION['oLoginAdm']->verificaPermissao("Varejista",$sOP,BANCO);
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Varejista",$sOP,BANCO);
if(!$bPermissao) {
	if($sOP == "Cadastrar"){
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou cadastrar informações na gerência de varejistas, porém não possui permissão para isso!";
	}else{
		if(isset($nIdVarejista) && $nIdVarejista != "" && $nIdVarejista != 0) {
			$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar dados do varejista ".utf8_decode($sNmVarejistaAcesso)." de id: ".$nIdVarejista.", porém não possui permissão para isso!";
		}else{
			$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar informações na gerência de varejistas, entretanto o id do varejista não foi carregado corretamente, a informação de id carregada no sistema foi o id:".$nIdVarejista.". De qualquer forma este usuário não possui permissão para alterar informações na gerência de varejistas!";
		}//if(isset($nIdVarejista) && $nIdVarejista != "" && $nIdVarejista != 0) {
	}//if($sOP == "Cadastrar"){
	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}else{
	$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." acessou a gerência de varejistas para ".$sOP." informações";
	if($sOP == "Alterar")
		$sObjeto .= " do varejista ".utf8_decode($sNmVarejistaAcesso)." de Id: ".$nIdVarejista;
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
	$tpl->MENUCONTEUDOATIVO = "active";
	$tpl->SUBMENUVAREJISTAATIVO = "active";
	$tpl->PAGINAATUAL = "Cadastro de Varejistas";

	//RODAPE
	require_once(PATH."painel/includes/rodape.php");
}

$tpl->ACAO = $sOP;
if(isset($nIdVarejista) && $nIdVarejista != "" && $nIdVarejista != 0){
	$oVarejistaDetalhe = $oFachadaConteudo->recuperaVarejista($nIdVarejista,BANCO);
	if(isset($oVarejistaDetalhe) && is_object($oVarejistaDetalhe)){
		$tpl->DATACADASTRO = $oVarejistaDetalhe->getDtCriacao();
		$tpl->IDVAREJISTA = $oVarejistaDetalhe->getId();
		$tpl->NOME = utf8_decode($oVarejistaDetalhe->getNmVarejista());
		$tpl->DESCRICAO = utf8_decode($oVarejistaDetalhe->getDescVarejista());
		$tpl->SITE = $oVarejistaDetalhe->getSite();

		if($oVarejistaDetalhe->getLogo() != ""){
			$tpl->LOGOATUAL = "<img src='logo/".$oVarejistaDetalhe->getLogo()."' width='40px' height='40px' />";
			$tpl->block("BLOCK_LOGO");
		}

		$tpl->CHECKEDPUBLICADO = ($oVarejistaDetalhe->getPublicado() == 1) ? "checked" : "";
		$tpl->CHECKEDATIVO = ($oVarejistaDetalhe->getAtivo() == 1) ? "checked" : "";
	}//if(isset($oVarejistaDetalhe) && is_object($oVarejistaDetalhe)){
}else{
	$tpl->DATACADASTRO = date("Y-m-d H:i:s");
	
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