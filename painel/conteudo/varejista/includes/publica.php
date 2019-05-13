<?php
require_once("../../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");

$oFachadaSeguranca = new FachadaSegurancaBD();
$oFachadaConteudo = new FachadaConteudoBD();

if(isset($_POST['id']) && $_POST['id'] != 0 && $_POST['id'] != ""){
	$oVarejista = $oFachadaConteudo->recuperaVarejista($_POST['id'],BANCO);
	if(is_object($oVarejista)){
		if($_POST['act'] == "publicarVarejista"){
			$oVarejista->setPublicado(1);
			$sTextoTransacao = "publicou";
			$sTextoFinal = "publicado";
		}else{
			$oVarejista->setPublicado(0);
			$sTextoTransacao = "despublicou";
			$sTextoFinal = "despublicado";
		}
		$nIdTipoTransacaoLogado = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Varejista","Alterar",BANCO);
		$sObjetoLogado = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." ".$sTextoTransacao." o varejista: ".utf8_decode($oVarejista->getNmVarejista())." de id ".$oVarejista->getId();
		$oTransacaoLogado = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacaoLogado,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoLogado),IP_USUARIO,DATAHORA,1,1);
		$oFachadaConteudo->alteraVarejista($oVarejista,$oTransacaoLogado,BANCO);
		//$sConteudo = "Varejista ".$sTextoFinal." com sucesso!";
		$sConteudo = "1";
	}else{
		$sConteudo = "Varejista não encontrado!";
	}
}else{
	$sConteudo = "Problemas na execução, tente novamente!";
}
echo $sConteudo;
?>