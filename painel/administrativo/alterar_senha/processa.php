<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/Validacao.class.php");

$oFachadaSeguranca = new FachadaSegurancaBD();
$oValidacao = new Validacao();

//print_r($_POST);
//die();

// VERIFICA AS PERMISSÕES
$sOP = (isset($_POST['sOP'])) ? $_POST['sOP'] : "";
$nIdTipoTransacao = $_SESSION['oLoginAdm']->recuperaTipoTransacaoPorDescricaoCategoria("Usuario",$sOP,BANCO);
$bPermissao = $_SESSION['oLoginAdm']->verificaPermissao("Usuario",$sOP,BANCO);
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Usuario",$sOP,BANCO);

//USUARIO AUXILIAR
$oUsuarioAuxiliar = $oFachadaSeguranca->recuperaUsuario($_POST['fIdUsuario'],BANCO);
if(is_object($oUsuarioAuxiliar)){
	$oGrupoUsuarioAuxiliar = $oFachadaSeguranca->recuperaGrupoUsuario($oUsuarioAuxiliar->getIdGrupoUsuario(),BANCO);
	if(is_object($oGrupoUsuarioAuxiliar))
		$sGrupoUsuarioAuxiliar = $oGrupoUsuarioAuxiliar->getNmGrupoUsuario();
		
	$sNmUsuarioAuxiliar = $oUsuarioAuxiliar->getNmUsuario();
}

if(!$bPermissao){
	//TRANSACAO
	$bPublicadoAcesso = (isset($_POST['fPublicado']) && $_POST['fPublicado'] == 1) ? "1" : "0";
	$bAtivoAcesso = (isset($_POST['fAtivo']) && $_POST['fAtivo'] == 1) ? "1" : "0";
	
	if($sOP != "Excluir"){
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou ".utf8_decode($sOP)." informações na gerência de usuários, porém não possui permissão para isso! Segue abaixo as informações:<br />";
		if($oUsuarioAuxiliar->getNmUsuario() != $_POST['fNome'])
			$sObjetoAcesso .= "Usuário: ".utf8_decode($oUsuarioAuxiliar->getNmUsuario())." --> ".utf8_decode($_POST['fNome'])."<br />";
		if($oUsuarioAuxiliar->getSenha() != $_POST['fSenha'] && $_POST['fSenha'] != "")
			$sObjetoAcesso .= "Senha: ".$oUsuarioAuxiliar->getSenha()." --> ".$_POST['fSenha']."<br />";
		if($oUsuarioAuxiliar->getEmail() != $_POST['fEmail'])
			$sObjetoAcesso .= "Email(s): ".$oUsuarioAuxiliar->getEmail()." --> ".$_POST['fEmail']."<br />";
	}else{
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou excluir informações da gerência de usuários, porém não possui permissão para isso! Segue abaixo as informações:<br />";
		if(count($_POST['fIdUsuario']) > 0){
			foreach($_POST['fIdUsuario'] as $nIdUsuario) {
				if ($oFachadaSeguranca->presenteUsuario($nIdUsuario,BANCO)){
					// TRANSACAO
					$oUsuarioAuxiliarAcesso = $oFachadaSeguranca->recuperaUsuario($nIdUsuario,BANCO);
					if(is_object($oUsuarioAuxiliarAcesso)){
						$sObjetoAcesso .= "Tentou excluir o usuário ".utf8_decode($oUsuarioAuxiliarAcesso->getNmUsuario())." de id=".$oUsuarioAuxiliarAcesso->getId()."<br />";
					}//if(is_object($oUsuarioAuxiliarAcesso)){
				}//if ($oFachadaSeguranca->presenteUsuario($nIdUsuario,BANCO)){
			}//foreach($_POST['fIdUsuario'] as $nIdUsuario) {
		}else{
			$sObjetoAcesso .= "Não houve envio de ids de usuários para exclusão!???<br />";
		}//if(count($_POST['fIdUsuario']) > 0){
	}//if($sOP != "Excluir"){
	
	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}//if(!$bPermissao){

// REGISTRANDO NA SESSÃO
if (isset($sOP) && $sOP != "Excluir"){
	$bLogado = (isset($_POST['fLogado']) && $_POST['fLogado'] == 1) ? "1" : "0";
	$bPublicado = (isset($_POST['fPublicado']) && $_POST['fPublicado'] == 1) ? "1" : "0";
	$bAtivo = (isset($_POST['fAtivo']) && $_POST['fAtivo'] == 1) ? "1" : "0";
	
	$oUsuario = $oFachadaSeguranca->inicializaUsuario($_POST['fIdUsuario'],$_POST['fIdGrupoUsuario'], utf8_encode($_POST['fNome']),$_POST['fLogin'],$_POST['fSenha'],$_POST['fEmail'],$bLogado,$_POST['fDataCadastro'],$bPublicado,$bAtivo);
	//print_r($oUsuario);
	//die();
	$_SESSION['oUsuario'] = $oUsuario;
	
	$sAtributosChave = "nId,bLogado,sEmail,sSenha,bPublicado,bAtivo";
	$_SESSION['sMsg'] = $oValidacao->verificaObjetoVazio($oUsuario,$sAtributosChave);
	if ($_SESSION['sMsg']){
		header("Location: ".SITE."painel/administrativo/alterar_senha/index.php?bErro=1");
		exit();
	}//if ($_SESSION['sMsg']){
	
	if (isset($_POST['fSenha']) && $_POST['fSenha'] != "") {
		if ($_POST['fSenha'] != $_POST['fSenhaConfirmacao']) {
			$_SESSION['sMsg'] = "A senha precisa ser igual a confirmação. Tente novamente!";
			header("Location: ".SITE."painel/administrativo/alterar_senha/index.php?bErro=1");
			exit();
		}//if ($_POST['fSenha'] != $_POST['fSenhaConfirmacao']) {
	}//if (isset($_POST['fSenha']) && $_POST['fSenha'] != "") {
}//if (isset($sOP) && $sOP != "Excluir"){

switch($sOP){
	case "AlterarSenha":
		$sHeader = "insere_altera.php?sOP=$sOP&bErro=1&nIdUsuario=".$_POST['fIdUsuario'];
		if(is_object($oUsuarioAuxiliar)){
			// TRANSACAO
			$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." efetuou alteração de Informações do Usuário ".utf8_decode($oUsuarioAuxiliar->getNmUsuario())."<br /> Modificações realizadas: <br />";
			if($oUsuarioAuxiliar->getNmUsuario() != $_POST['fNome'])
				$sObjeto .= "Usuário: ".utf8_decode($oUsuarioAuxiliar->getNmUsuario())." --> ".utf8_encode($_POST['fNome'])."<br />";
			if($oUsuarioAuxiliar->getSenha() != $_POST['fSenha'] && $_POST['fSenha'] != "")
				$sObjeto .= "Senha: ".$oUsuarioAuxiliar->getSenha()." --> ".$_POST['fSenha']."<br />";
			if($oUsuarioAuxiliar->getEmail() != $_POST['fEmail'])
				$sObjeto .= "Email(s): ".$oUsuarioAuxiliar->getEmail()." --> ".$_POST['fEmail']."<br />";

			$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);

			// CASO NÃO SEJA INFORMADO UMA NOVA SENHA DEVE SETAR A QUE ESTÁ NO BANCO
			if(trim($_POST['fSenha']) == "")
				$oUsuario->setSenha($oUsuarioAuxiliar->getSenha());

			if (!$oFachadaSeguranca->alteraUsuario($oUsuario,$oTransacao,BANCO)){
				//TRANSACAO
				$sObjetoAcesso = "VERIFICAR: Tentativa de alteração de informações do usuário ".utf8_decode($oUsuarioAuxiliar->getNmUsuario())." falhou. Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar as informações do usuário ".utf8_decode($oUsuarioAuxiliar->getNmUsuario()).", porém houve erro na alteração. Modificações que seriam realizadas e não foram concluídas: <br />";
				if($oUsuarioAuxiliar->getNmUsuario() != $_POST['fNome'])
					$sObjetoAcesso .= "Usuário: ".utf8_decode($oUsuarioAuxiliar->getNmUsuario())." --> ".utf8_encode($_POST['fNome'])."<br />";
				if($oUsuarioAuxiliar->getSenha() != $_POST['fSenha'] && $_POST['fSenha'] != "")
					$sObjetoAcesso .= "Senha: ".$oUsuarioAuxiliar->getSenha()." --> ".$_POST['fSenha']."<br />";
				if($oUsuarioAuxiliar->getEmail() != $_POST['fEmail'])
					$sObjetoAcesso .= "Email(s): ".$oUsuarioAuxiliar->getEmail()." --> ".$_POST['fEmail']."<br />";

				$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
				$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
				$_SESSION['sMsg'] = "Não foi possível alterar as informações!";
				$sHeader = "index.php?bErro=1";
			} else {
				$_SESSION['sMsg'] = "Informações alteradas com sucesso!";
				$sHeader = "index.php?bErro=0";
				$_SESSION['oUsuario'] = "";
				unset($_SESSION['oUsuario']);
				unset($_POST);		
			}//if ($oFachadaSeguranca->insereUsuario($oUsuario))
		} else {
			$_SESSION['sMsg'] = "Usuário não encontrado no sistema!";
		}//if(is_object($oUsuarioAuxiliar)){
	break;
	default:
		$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
		header("location: ".SITE."painel/index.php?bErro=1");
		exit();
	break;
}	
header("Location: ".SITE."painel/administrativo/alterar_senha/".$sHeader);
?>