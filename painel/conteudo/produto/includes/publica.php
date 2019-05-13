<?php
require_once("../../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");

$oFachadaSeguranca = new FachadaSegurancaBD();
$oFachadaConteudo = new FachadaConteudoBD();

if(isset($_POST['id']) && $_POST['id'] != 0 && $_POST['id'] != ""){
	$oProduto = $oFachadaConteudo->recuperaProduto($_POST['id'],BANCO);
	if(is_object($oProduto)){
		if($_POST['act'] == "publicarProduto"){
			$oProduto->setPublicado(1);
			$sTextoTransacao = "publicou";
			$sTextoFinal = "publicado";
		}else{
			$oProduto->setPublicado(0);
			$sTextoTransacao = "despublicou";
			$sTextoFinal = "despublicado";
		}
		$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Produto","Alterar",BANCO);
		$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." ".$sTextoTransacao." o produto: ".utf8_decode($oProduto->getNmProduto())." de id ".$oProduto->getId();
		$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);
		$oFachadaConteudo->alteraProduto($oProduto,$oTransacao,BANCO);
		//$sConteudo = "Produto ".$sTextoFinal." com sucesso!";
		$sConteudo = "1";
	}else{
		$sConteudo = "Produto não encontrado!";
	}
}else{
	$sConteudo = "Problemas na execução, tente novamente!";
}
echo $sConteudo;
?>