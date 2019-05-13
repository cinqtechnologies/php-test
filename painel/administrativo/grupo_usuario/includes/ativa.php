<?php
require_once("../../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");

$oFachadaSeguranca = new FachadaSegurancaBD();

if(isset($_POST['id']) && $_POST['id'] != 0 && $_POST['id'] != ""){
	$oGrupoUsuario = $oFachadaSeguranca->recuperaGrupoUsuario($_POST['id'],BANCO);
	if(is_object($oGrupoUsuario)){
		if($_POST['act'] == "ativarGrupoUsuario"){
			$oGrupoUsuario->setAtivo(1);
			$sTextoTransacao = "ativou";
			$sTextoFinal = "ativado";
		}else{
			$oGrupoUsuario->setAtivo(0);
			$sTextoTransacao = "desativou";
			$sTextoFinal = "desativado";
		}
		$nIdTipoTransacaoLogado = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Grupos","Alterar",BANCO);
		$sObjetoLogado = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." ".utf8_decode($sTextoTransacao)." o grupo de usuários: ".utf8_decode($oGrupoUsuario->getNmGrupoUsuario())." de id ".$oGrupoUsuario->getId();
		$oTransacaoLogado = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacaoLogado,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoLogado),IP_USUARIO,DATAHORA,1,1);
		$oFachadaSeguranca->alteraGrupoUsuario($oGrupoUsuario,$oTransacaoLogado,BANCO);
		//$sConteudo = "Grupo de Usuários ".$sTextoFinal." com sucesso!";
		$sConteudo = "1";
	}else{
		$sConteudo = "Grupo de Usuários não encontrado!";
	}
}else{
	$sConteudo = "Problemas na execução, tente novamente!";
}
echo $sConteudo;
?>