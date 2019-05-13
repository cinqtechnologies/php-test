<?php
require_once("../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/Template.class.php");

$tpl = new Template('tpl/index.html');

$tpl->addFile('HEAD','../includes/head.html');
$tpl->addFile('TOPO_PAINEL','../includes/topo_painel.html');
$tpl->addFile('MENU_LATERAL','../includes/menu_lateral.html');
$tpl->addFile('SCRIPTJS','../includes/scriptsjs.html');
$tpl->addFile('RODAPE','../includes/rodape.html');
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
    $tpl->PAGINAATUAL = "Gerência de Conteúdo";

    //RODAPE
    require_once(PATH."painel/includes/rodape.php");
    
    // VERIFICA AS PERMISSÕES
    $bPermissaoVisualizarVarejista = $_SESSION['oLoginAdm']->verificaPermissao("Varejista","Visualizar",BANCO);
    $bPermissaoVisualizarProduto = $_SESSION['oLoginAdm']->verificaPermissao("Produto","Visualizar",BANCO);

    if((isset($bPermissaoVisualizarVarejista) && $bPermissaoVisualizarVarejista == 1) || (isset($bPermissaoVisualizarProduto) && $bPermissaoVisualizarProduto == 1)){

        if(isset($bPermissaoVisualizarVarejista) && $bPermissaoVisualizarVarejista == 1){
            $tpl->LINKMENUPVAREJISTA = "{CAMINHO}painel/conteudo/varejista/index.php";
            $tpl->block("BLOCK_MENUP_VAREJISTA");
        }

        if(isset($bPermissaoVisualizarProduto) && $bPermissaoVisualizarProduto == 1){
            $tpl->LINKMENUPPRODUTO = "{CAMINHO}painel/conteudo/produto/index.php";
            $tpl->block("BLOCK_MENUP_PRODUTO");
        }

        $tpl->block("BLOCK_MENUP_CONTEUDO");

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