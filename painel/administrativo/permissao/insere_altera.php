<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/Template.class.php");

// VERIFICA AS PERMISSÕES
$nIdGrupoUsuario = (isset($_GET['nIdGrupoUsuario']) && $_GET['nIdGrupoUsuario'] != "" && $_GET['nIdGrupoUsuario'] != 0) ? $_GET['nIdGrupoUsuario'] : ((isset($_POST['fIdGrupoUsuario'][0]) && $_POST['fIdGrupoUsuario'][0] != "" && $_POST['fIdGrupoUsuario'][0] != 0) ? $_POST['fIdGrupoUsuario'][0] : "");
$sOP = "Alterar";
$oFachadaSeguranca = new FachadaSegurancaBD();
$bPermissao = $_SESSION['oLoginAdm']->verificaPermissao("Permissao","Alterar",BANCO);
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Permissao","Alterar",BANCO);
if(isset($nIdGrupoUsuario) && $nIdGrupoUsuario != "" && $nIdGrupoUsuario != 0) {
	$oGrupoUsuarioAcesso = $oFachadaSeguranca->recuperaGrupoUsuario($nIdGrupoUsuario,BANCO);
	if(is_object($oGrupoUsuarioAcesso)){
		$nIdGrupoUsuarioAcesso = $oGrupoUsuarioAcesso->getId();
		$sNmGrupoUsuarioAcesso = $oGrupoUsuarioAcesso->getNmGrupoUsuario();
	}//if(is_object($oGrupoUsuarioAcesso)){
}//if(isset($nIdGrupoUsuario) && $nIdGrupoUsuario != "" && $nIdGrupoUsuario != 0) {
if(!$bPermissao) {
	if(isset($nIdGrupoUsuario) && $nIdGrupoUsuario != "" && $nIdGrupoUsuario != 0) {
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar as permissões do grupo de usuários ".utf8_decode($sNmGrupoUsuarioAcesso)." de id: ".$nIdGrupoUsuarioAcesso.", porém não possui permissão para isso!";
	}//if(isset($nIdGrupoUsuario) && $nIdGrupoUsuario != "" && $nIdGrupoUsuario != 0) {

	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}else{
	if(isset($nIdGrupoUsuario) && $nIdGrupoUsuario != "" && $nIdGrupoUsuario != 0) {
		$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." acessou a gerência de grupos de usuários para alterar as permissões do grupo de usuários ".$sNmGrupoUsuarioAcesso;
		$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);
		$oFachadaSeguranca->insereTransacao($oTransacao,BANCO);
	}//if(isset($nIdGrupoUsuario) && $nIdGrupoUsuario != "" && $nIdGrupoUsuario != 0) {
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
	$tpl->PAGINAATUAL = "Edição de Permissões de Grupos de Usuários";

	//RODAPE
	require_once(PATH."painel/includes/rodape.php");
}

$tpl->ACAO = $sOP;
$tpl->DATACADASTRO = date("Y-m-d H:i:s");

$oGrupoUsuario = $oFachadaSeguranca->recuperaGrupoUsuario($nIdGrupoUsuario,BANCO);

$vWhereCategoriaTipoTransacao = array("publicado = 1","ativo = 1");
$sOrderCategoriaTipoTransacao = "descricao asc";
$voCategoriaTipoTransacao = $oFachadaSeguranca->recuperaTodosCategoriaTipoTransacao(BANCO,$vWhereCategoriaTipoTransacao,$sOrderCategoriaTipoTransacao);

$vWherePermissao = array("publicado = 1","ativo = 1","id_grupo_usuario = ".$nIdGrupoUsuario);
$voPermissao = $oFachadaSeguranca->recuperaTodosPermissao(BANCO,$vWherePermissao);
$vIdTransacao = array();

if(isset($voPermissao) && count($voPermissao)){
    foreach($voPermissao as $oPermissao){
        if(isset($oPermissao) && is_object($oPermissao)){
            if(!in_array($oPermissao->getIdTipoTransacao(),$vIdTransacao))
                array_push($vIdTransacao,$oPermissao->getIdTipoTransacao());
        }
    }
}

if(isset($oGrupoUsuario) && is_object($oGrupoUsuario)){
	$tpl->IDGRUPOUSUARIO = $oGrupoUsuario->getId();
	
	if(isset($voCategoriaTipoTransacao) && count($voCategoriaTipoTransacao) > 0){
		foreach($voCategoriaTipoTransacao as $oCategoriaTipoTransacao){
			if(isset($oCategoriaTipoTransacao) && is_object($oCategoriaTipoTransacao)){
				$tpl->CATEGORIATIPOTRANSACAO = $oCategoriaTipoTransacao->getDescricao();
				
				$vWhereTipoTransacao = array("id_categoria_tipo_transacao = ".$oCategoriaTipoTransacao->getId(),"publicado = 1","ativo = 1");
				$sOrderTipoTransacao = "transacao asc";
				$voTipoTransacao = $oFachadaSeguranca->recuperaTodosTipoTransacao(BANCO,$vWhereTipoTransacao,$sOrderTipoTransacao);
				if(isset($voTipoTransacao) && count($voTipoTransacao) > 0){
					foreach($voTipoTransacao as $oTipoTransacao){
						if(isset($oTipoTransacao) && is_object($oTipoTransacao)){
							$tpl->IDTIPOTRANSACAO = $oTipoTransacao->getId();
							$tpl->TIPOTRANSACAO = $oTipoTransacao->getTransacao();
							$tpl->CHECKEDTIPOTRANSACAO = "";
							if(in_array($oTipoTransacao->getId(),$vIdTransacao))
								$tpl->CHECKEDTIPOTRANSACAO = "checked";
							$tpl->block("BLOCO_TIPO_TRANSACAO");
						}//if(isset($oTipoTransacao) && is_object($oTipoTransacao)){
					}//foreach($voTipoTransacao as $oTipoTransacao){
				}//if(isset($voTipoTransacao) && count($voTipoTransacao) > 0){
				
				$tpl->block("BLOCO_CATEGORIA_TIPO_TRANSACAO");
			}//if(isset($oCategoriaTipoTransacao) && is_object($oCategoriaTipoTransacao)){
		}//foreach($voCategoriaTipoTransacao as $oCategoriaTipoTransacao){
	}//if(isset($voCategoriaTipoTransacao) && count($voCategoriaTipoTransacao) > 0){
}

$tpl->CAMINHO = CAMINHO;

if(isset($_SESSION['oPermissao']))
	unset($_SESSION['oPermissao']);
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