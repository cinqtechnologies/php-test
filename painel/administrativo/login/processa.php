<?php 
require_once("../../../constantes.php");
require_once(PATH."/classes/Login.class.php");
session_start();

$sOP = (isset($_POST['sOP']) && $_POST['sOP'] != "") ? $_POST['sOP'] : ((isset($_GET['sOP']) && $_GET['sOP'] != "") ? $_GET['sOP'] : "");

//print_r($_REQUEST);
//die();
if((isset($sOP) && $sOP == "Logar") && ((isset($_POST['fLogin']) && $_POST['fLogin'] == "") || (isset($_POST['fSenha']) && $_POST['fSenha'] == ""))){
	$_SESSION['sMsgPermissao'] = "Informe o login e a senha para ter acesso ao Painel Administrativo!";
	//header("Location: ../../index.php?bErro=1");
	echo "0_".$_SESSION['sMsgPermissao'];
	exit();
}

switch($sOP){
	case "Logar":
		$oLoginAdm = new Login();
		if($oLoginAdm->logarUsuarioPainel($_POST['fLogin'],$_POST['fSenha'],BANCO)) {
			$_SESSION['oLoginAdm'] = $oLoginAdm;
			$_SESSION['sMsgPermissao'] = "";
			$_SESSION["dUltimoAcesso"]= date("Y-m-d H:i:s");
			//$sHeader = "../../index.php?bErro=0";
			echo "1_";
		} else {
			$_SESSION['sMsgPermissao'] = "Problemas na identificação. Verifique se os seus dados estão corretos.";
			//$sHeader = "../../index.php?bErro=1";
			echo "2_".$_SESSION['sMsgPermissao'];
		}
	break;
	case "Logoff":
		$oFachadaSeguranca = new FachadaSegurancaBD();
		$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Acesso","Logout",BANCO);
		if(isset($_SESSION['oLoginAdm']) && $_SESSION['oLoginAdm']->getIdUsuario() != "" && $_SESSION['oLoginAdm']->getIdUsuario() != 0){
			$oUsuarioLogoff = $oFachadaSeguranca->recuperaUsuario($_SESSION['oLoginAdm']->getIdUsuario(),BANCO);
			if(is_object($oUsuarioLogoff)){
				$oUsuarioLogoff->setLogado(0);
				$sObjetoLogado = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." liberou a disponibilidade de novo login para o usuário: ".$oUsuarioLogoff->getLogin();
				$oTransacaoLogado = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoLogado),IP_USUARIO,DATAHORA,1,1);
				$oFachadaSeguranca->alteraUsuario($oUsuarioLogoff,$oTransacaoLogado,BANCO);
				
				//TRANSACAO
				$sObjetoLogoff = "Logout efetuado. Usuario: ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario()).", Login do usuário: ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getLogin());
				$oTransacaoOff = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoLogoff),IP_USUARIO,DATAHORA,1,1);
				$oFachadaSeguranca->insereTransacao($oTransacaoOff,BANCO);
				echo "1";
			}else{
				//TRANSACAO
				$sObjetoLogoff = "VERIFICAR ERRO LOGOFF: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." não encontrado no sistema para logoff!";
				$oTransacaoOff = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoLogoff),IP_USUARIO,DATAHORA,1,1);
				$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoOff,BANCO);
				echo "1";
			}//if(is_object($oUsuarioLogoff)){
		}else{
			//TRANSACAO
			$sObjetoLogoff = "VERIFICAR: Executado o comando de Logout, sem nenhuma sessão da área administrativa estar ativa!";
			$oTransacaoOff = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,ID_USUARIO_SISTEMA,utf8_encode($sObjetoLogoff),IP_USUARIO,DATAHORA,1,1);
			$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoOff,BANCO);
			echo "1";
		}//if(isset($_SESSION['oLoginAdm']) && $_SESSION['oLoginAdm']->getIdUsuario() != "" && $_SESSION['oLoginAdm']->getIdUsuario() != 0){
		$_SESSION['sMsgPermissao'] = "";
		$_SESSION['oLoginAdm'] = "";
		unset($_SESSION['oLoginAdm']);
		session_destroy();
		//unset($_SESSION['vsMenu']);
		//$sHeader = "../../index.php";
	break;
}
//header("Location:$sHeader");
?>