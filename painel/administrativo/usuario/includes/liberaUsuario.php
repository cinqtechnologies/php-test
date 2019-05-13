<?php
require_once("../../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");

$oFachadaSeguranca = new FachadaSegurancaBD();
//print_r($_POST);
//die();

if(isset($_POST['id']) && $_POST['id'] != 0 && $_POST['id'] != ""){
	if(isset($_POST['act']) && $_POST['act'] == "liberarUsuario"){
		$oUsuario = $oFachadaSeguranca->recuperaUsuario($_POST['id'],BANCO);
		if(is_object($oUsuario)){
			$oUsuario->setLogado(0);
			$nIdTipoTransacaoLogado = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Usuario","Alterar",BANCO);
			$sObjetoLogado = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." liberou a disponibilidade de novo login para o usuário: ".utf8_decode($oUsuario->getLogin());
			$oTransacaoLogado = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacaoLogado,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoLogado),IP_USUARIO,DATAHORA,1,1);
			$oFachadaSeguranca->alteraUsuario($oUsuario,$oTransacaoLogado,BANCO);
			$oUsuarioAuxiliar = $oFachadaSeguranca->recuperaUsuario($oUsuario->getId(),BANCO);
			if(is_object($oUsuarioAuxiliar) && $oUsuarioAuxiliar->getLogado() == 0){
				$sConteudo = "1";
			}else{
				$sConteudo = "Não foi possível liberar o usuário!";
			}
		}else{
			$sConteudo = "Usuário não encontrado!";
		}
	}//if(isset($_POST['act']) && $_POST['act'] == "liberarUsuario"){
}else{
	$sConteudo = "Problemas na execução, tente novamente!";
}//if(isset($_POST['id']) && $_POST['id'] != 0 && $_POST['id'] != ""){
echo $sConteudo;
?>