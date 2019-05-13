<?php
require_once("../../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");

$oFachadaSeguranca = new FachadaSegurancaBD();

if(isset($_POST['id']) && $_POST['id'] != 0 && $_POST['id'] != ""){
	$oUsuario = $oFachadaSeguranca->recuperaUsuario($_POST['id'],BANCO);
	if(is_object($oUsuario)){
		if($_POST['act'] == "ativarUsuario"){
			$oUsuario->setAtivo(1);
			$sTextoTransacao = "ativou";
			$sTextoFinal = "ativado";
		}else{
			$oUsuario->setAtivo(0);
			$sTextoTransacao = "desativou";
			$sTextoFinal = "desativado";
		}
		$nIdTipoTransacaoLogado = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Usuario","Alterar",BANCO);
		$sObjetoLogado = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." ".$sTextoTransacao." o usuário: ".utf8_decode($oUsuario->getLogin())." de id ".$oUsuario->getId();
		$oTransacaoLogado = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacaoLogado,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoLogado),IP_USUARIO,DATAHORA,1,1);
		$oFachadaSeguranca->alteraUsuario($oUsuario,$oTransacaoLogado,BANCO);
		//$sConteudo = "Usuário ".$sTextoFinal." com sucesso!";
		$sConteudo = "1";
	}else{
		$sConteudo = "Usuário não encontrado!";
	}
}else{
	$sConteudo = "Problemas na execução, tente novamente!";
}
echo $sConteudo;
?>