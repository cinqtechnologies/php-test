<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/Template.class.php");

// VERIFICA AS PERMISSÕES
$bPermissaoVisualizar = $_SESSION['oLoginAdm']->verificaPermissao("Transacao","Visualizar",BANCO);
$oFachadaSeguranca = new FachadaSegurancaBD();
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Transacao","Visualizar",BANCO);
if(!$bPermissaoVisualizar) {
	$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou acessar a gerência de transações do sistema, porém não possui permissão para isso!";
	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}else{
	$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." acessou a gerência de transações do sistema!";
	$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacao($oTransacao,BANCO);
}

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
	$tpl->SUBMENUTRANSACOESATIVO = "active";
	$tpl->PAGINAATUAL = "Gerência de Transações";

	//RODAPE
	require_once(PATH."painel/includes/rodape.php");
}

$sPublicado = "";
$sAtivo = "";
$sPublicadoAcao = "";
$sAtivoAcao = "";
$vWhereCategoriaTipoTransacao = array();
$sOrderCategoriaTipoTransacao = "descricao asc";
$voCategoriaTipoTransacao = $oFachadaSeguranca->recuperaTodosCategoriaTipoTransacao(BANCO,$vWhereCategoriaTipoTransacao,$sOrderCategoriaTipoTransacao);
if(isset($voCategoriaTipoTransacao) && count($voCategoriaTipoTransacao) > 0){
	foreach($voCategoriaTipoTransacao as $oCategoriaTipoTransacao){
		if(isset($oCategoriaTipoTransacao) && is_object($oCategoriaTipoTransacao)){
			$tpl->IDCATEGORIATRANSACAO = $oCategoriaTipoTransacao->getId();
			
			$sPublicado = '<font color="#FF0000">Despublicado</font>';
			if($oCategoriaTipoTransacao->getPublicado() == 1)
				$sPublicado = '<font color="#0000FF">Publicado</font>';
			
			$sAtivo = '<font color="#FF0000">Desativado</font>';
			if($oCategoriaTipoTransacao->getAtivo() == 1)
				$sAtivo = '<font color="#0000FF">Ativo</font>';
			
			$tpl->CATEGORIATRANSACAO = utf8_decode($oCategoriaTipoTransacao->getDescricao())." (".$sPublicado.") (".$sAtivo.")";
			
			$vWhereTipoTransacao = array("id_categoria_tipo_transacao = ".$oCategoriaTipoTransacao->getId());
			$sOrderTipoTransacao = "transacao asc";
			$voTipoTransacao = $oFachadaSeguranca->recuperaTodosTipoTransacao(BANCO,$vWhereTipoTransacao,$sOrderTipoTransacao);
			if(isset($voTipoTransacao) && count($voTipoTransacao) > 0){
				foreach($voTipoTransacao as $oTipoTransacao){
					if(isset($oTipoTransacao) && is_object($oTipoTransacao)){
						
						$sPublicadoAcao = '<font color="#FF0000">Despublicado</font>';
						if($oTipoTransacao->getPublicado() == 1)
							$sPublicadoAcao = '<font color="#0000FF">Publicado</font>';
						
						$sAtivoAcao = '<font color="#FF0000">Desativado</font>';
						if($oTipoTransacao->getAtivo() == 1)
							$sAtivoAcao = '<font color="#0000FF">Ativo</font>';
						
						$tpl->TRANSACAO = utf8_decode($oTipoTransacao->getTransacao())." (".$sPublicadoAcao.") (".$sAtivoAcao.")<br />";
						$tpl->block("BLOCO_ACAO");
					}
				}
			}
			
			$tpl->block("BLOCO_TRANSACAO");
		}
	}
}

$tpl->CAMINHO = CAMINHO;

if(isset($_SESSION['oCategoriaTipoTransacao']))
	unset($_SESSION['oCategoriaTipoTransacao']);
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