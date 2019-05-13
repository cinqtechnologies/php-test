<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/Template.class.php");

$nIdUsuario = (isset($_GET['nIdUsuario']) && $_GET['nIdUsuario'] != "" && $_GET['nIdUsuario'] != 0) ? $_GET['nIdUsuario'] : ((isset($_POST['fIdUsuario'][0]) && $_POST['fIdUsuario'][0] != "" && $_POST['fIdUsuario'][0] != 0) ? $_POST['fIdUsuario'][0] : "");
$sOP = ($nIdUsuario != "") ? "Alterar" : "Cadastrar"; 
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
	if($sOP == "Cadastrar"){
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou cadastrar informações na gerência de usuários, porém não possui permissão para isso!";
	}else{
		if(isset($nIdUsuario) && $nIdUsuario != "" && $nIdUsuario != 0) {
			$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar dados do usuário ".utf8_decode($sNmUsuarioAcesso)." de id: ".$nIdUsuario.", porém não possui permissão para isso!";
		}else{
			$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar informações na gerência de usuários, entretanto o id do usuário não foi carregado corretamente, a informação de id carregada no sistema foi o id:".$nIdUsuario.". De qualquer forma este usuário não possui permissão para alterar informações na gerência de usuários!";
		}//if(isset($nIdUsuario) && $nIdUsuario != "" && $nIdUsuario != 0) {
	}//if($sOP == "Cadastrar"){
	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}else{
	$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." acessou a gerência de usuários para ".$sOP." informações";
	if($sOP == "Alterar")
		$sObjeto .= " do Usuário ".utf8_decode($sNmUsuarioAcesso)." de Id: ".$nIdUsuario;
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
	$tpl->SUBMENUUSUARIOSATIVO = "active";
	$tpl->PAGINAATUAL = "Cadastro de Usuários";

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
		
		if(isset($voGrupoUsuario) && count($voGrupoUsuario) > 0){
			foreach($voGrupoUsuario as $oGrupoUsuario){
				if(isset($oGrupoUsuario) && is_object($oGrupoUsuario)){
					$tpl->IDGRUPOUSUARIO = $oGrupoUsuario->getId();
					$tpl->GRUPOUSUARIO = $oGrupoUsuario->getNmGrupoUsuario();
					$tpl->SELECTEDGRUPOUSUARIO = "";
					if($oGrupoUsuario->getId() == $oUsuarioDetalhe->getIdGrupoUsuario())
						$tpl->SELECTEDGRUPOUSUARIO = "selected";
					$tpl->block("BLOCO_GRUPO_USUARIOS");
				}
			}
		}
		
		$tpl->LOGIN = utf8_decode($oUsuarioDetalhe->getLogin());
		$tpl->CHECKEDPUBLICADO = ($oUsuarioDetalhe->getPublicado() == 1) ? "checked" : "";
		$tpl->CHECKEDATIVO = ($oUsuarioDetalhe->getAtivo() == 1) ? "checked" : "";
	}//if(isset($oUsuarioDetalhe) && is_object($oUsuarioDetalhe)){
}else{
	$tpl->VALIDASENHA = "validate[required]";
	$tpl->DATACADASTRO = date("Y-m-d H:i:s");
	if(isset($voGrupoUsuario) && count($voGrupoUsuario) > 0){
		foreach($voGrupoUsuario as $oGrupoUsuario){
			if(isset($oGrupoUsuario) && is_object($oGrupoUsuario)){
				$tpl->IDGRUPOUSUARIO = $oGrupoUsuario->getId();
				$tpl->GRUPOUSUARIO = $oGrupoUsuario->getNmGrupoUsuario();
				$tpl->SELECTEDGRUPOUSUARIO = "";
				$tpl->block("BLOCO_GRUPO_USUARIOS");
			}
		}
	}
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