<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");
require_once(PATH."/classes/Template.class.php");

$nIdProduto = (isset($_GET['nIdProduto']) && $_GET['nIdProduto'] != "" && $_GET['nIdProduto'] != 0) ? $_GET['nIdProduto'] : ((isset($_POST['fIdProduto'][0]) && $_POST['fIdProduto'][0] != "" && $_POST['fIdProduto'][0] != 0) ? $_POST['fIdProduto'][0] : "");
$sOP = ($nIdProduto != "") ? "Alterar" : "Cadastrar"; 
$oFachadaSeguranca = new FachadaSegurancaBD();
$oFachadaConteudo = new FachadaConteudoBD();

if(isset($nIdProduto) && $nIdProduto != "" && $nIdProduto != 0) {
	$oProdutoAcesso = $oFachadaConteudo->recuperaProduto($nIdProduto,BANCO);
	if(is_object($oProdutoAcesso)){
		$sNmProdutoAcesso = $oProdutoAcesso->getNmProduto();
	}//if(is_object($oProdutoAcesso)){
}//if(isset($nIdProduto) && $nIdProduto != "" && $nIdProduto != 0) {

$bPermissao = $_SESSION['oLoginAdm']->verificaPermissao("Produto",$sOP,BANCO);
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Produto",$sOP,BANCO);
if(!$bPermissao) {
	if($sOP == "Cadastrar"){
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou cadastrar informações na gerência de produtos, porém não possui permissão para isso!";
	}else{
		if(isset($nIdProduto) && $nIdProduto != "" && $nIdProduto != 0) {
			$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar dados do produto ".utf8_decode($sNmProdutoAcesso)." de id: ".$nIdProduto.", porém não possui permissão para isso!";
		}else{
			$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar informações na gerência de produtos, entretanto o id do produto não foi carregado corretamente, a informação de id carregada no sistema foi o id:".$nIdProduto.". De qualquer forma este usuário não possui permissão para alterar informações na gerência de produtos!";
		}//if(isset($nIdProduto) && $nIdProduto != "" && $nIdProduto != 0) {
	}//if($sOP == "Cadastrar"){
	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}else{
	$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." acessou a gerência de produtos para ".$sOP." informações";
	if($sOP == "Alterar")
		$sObjeto .= " do produto ".utf8_decode($sNmProdutoAcesso)." de Id: ".$nIdProduto;
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
	$tpl->MENUCONTEUDOATIVO = "active";
	$tpl->SUBMENUPRODUTOATIVO = "active";
	$tpl->PAGINAATUAL = "Cadastro de Produtos";

	//RODAPE
	require_once(PATH."painel/includes/rodape.php");
}

$voVarejista = $oFachadaConteudo->recuperaTodosVarejista(BANCO);

$tpl->ACAO = $sOP;
if(isset($nIdProduto) && $nIdProduto != "" && $nIdProduto != 0){
	$oProdutoDetalhe = $oFachadaConteudo->recuperaProduto($nIdProduto,BANCO);
	if(isset($oProdutoDetalhe) && is_object($oProdutoDetalhe)){
		$tpl->DATACADASTRO = $oProdutoDetalhe->getDtCriacao();
		$tpl->IDPRODUTO = $oProdutoDetalhe->getId();
		$tpl->NOME = utf8_decode($oProdutoDetalhe->getNmProduto());
		$tpl->DESCRICAO = utf8_decode($oProdutoDetalhe->getDescProduto());
		$tpl->PRECO = number_format($oProdutoDetalhe->getPreco(),2,',','.');

		if(isset($voVarejista) && count($voVarejista) > 0){
			foreach($voVarejista as $oVarejista){
				if(isset($oVarejista) && is_object($oVarejista)){
					$tpl->IDVAREJISTA = $oVarejista->getId();
					$tpl->VAREJISTA = utf8_decode($oVarejista->getNmVarejista());
					$tpl->SELECTEDVAREJISTA = "";
					if($oVarejista->getId() == $oProdutoDetalhe->getIdVarejista())
						$tpl->SELECTEDVAREJISTA = "selected";
					$tpl->block("BLOCK_VAREJISTAS");
				}
			}
		}

		if($oProdutoDetalhe->getImagem() != ""){
			$tpl->IMAGEMATUAL = "<img src='imagem/".$oProdutoDetalhe->getImagem()."' width='40px' height='40px' />";
			$tpl->block("BLOCK_IMAGEM");
		}

		$tpl->CHECKEDPUBLICADO = ($oProdutoDetalhe->getPublicado() == 1) ? "checked" : "";
		$tpl->CHECKEDATIVO = ($oProdutoDetalhe->getAtivo() == 1) ? "checked" : "";
	}//if(isset($oProdutoDetalhe) && is_object($oProdutoDetalhe)){
}else{
	$tpl->DATACADASTRO = date("Y-m-d H:i:s");
	
	if(isset($voVarejista) && count($voVarejista) > 0){
		foreach($voVarejista as $oVarejista){
			if(isset($oVarejista) && is_object($oVarejista)){
				$tpl->IDVAREJISTA = $oVarejista->getId();
				$tpl->VAREJISTA = utf8_decode($oVarejista->getNmVarejista());
				$tpl->SELECTEDVAREJISTA = "";
				$tpl->block("BLOCK_VAREJISTAS");
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