<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/Data.class.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/Template.class.php");

$nIdCategoriaTipoTransacao = (isset($_GET['nIdCategoriaTipoTransacao']) && $_GET['nIdCategoriaTipoTransacao'] != "" && $_GET['nIdCategoriaTipoTransacao'] != 0) ? $_GET['nIdCategoriaTipoTransacao'] : ((isset($_POST['fIdCategoriaTipoTransacao'][0]) && $_POST['fIdCategoriaTipoTransacao'][0] != "" && $_POST['fIdCategoriaTipoTransacao'][0] != 0) ? $_POST['fIdCategoriaTipoTransacao'][0] : "");
$sOP = ($nIdCategoriaTipoTransacao) ? "Alterar" : "Cadastrar"; 

$oFachadaSeguranca = new FachadaSegurancaBD();
if(isset($nIdCategoriaTipoTransacao) && $nIdCategoriaTipoTransacao != "" && $nIdCategoriaTipoTransacao != 0) {
  $oCategoriaTipoTransacaoAcesso = $oFachadaSeguranca->recuperaCategoriaTipoTransacao($nIdCategoriaTipoTransacao,BANCO);
  if(is_object($oCategoriaTipoTransacaoAcesso))
    $sCategoriaTipoTransacaoAcesso = $oCategoriaTipoTransacaoAcesso->getDescricao();
}

// VERIFICA AS PERMISSÕES
$bPermissao = $_SESSION['oLoginAdm']->verificaPermissao("Transacao",$sOP,BANCO);
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Transacao",$sOP,BANCO);
if(!$bPermissao) {
  if($sOP == "Cadastrar"){
    $sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou cadastrar informações na gerência de transações do sistema, porém não possui permissão para isso!";
  }else{
    if(isset($nIdCategoriaTipoTransacao) && $nIdCategoriaTipoTransacao != "" && $nIdCategoriaTipoTransacao != 0) {
      $sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar as informações da Categoria de Tipo de Transação ".utf8_decode($sCategoriaTipoTransacaoAcesso)." de id: ".$nIdCategoriaTipoTransacao.", porém não possui permissão para isso!";
    }else{
      $sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar informações na gerência de transações, entretanto o id da Categoria de Tipo de Transação não foi carregado corretamente, a informação de id carregada no sistema foi o id:".$nIdCategoriaTipoTransacao.". De qualquer forma este usuário não possui permissão para alterar informações na gerência de transações!";
    }//if(isset($nIdCategoriaTipoTransacao) && $nIdCategoriaTipoTransacao != "" && $nIdCategoriaTipoTransacao != 0) {
  }//if($sOP == "Cadastrar"){
  $oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
  $oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
  $_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
  header("location: ".SITE."painel/index.php?bErro=1");
  exit();
}else{
  $sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." acessou a gerência de transações para ".$sOP." informações";
  if($sOP == "Alterar")
    $sObjeto .= " da Categoria de Tipo de Transações ".utf8_decode($sCategoriaTipoTransacaoAcesso)." de Id: ".$nIdCategoriaTipoTransacao;
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
  $tpl->MENUADMATIVO = "active";
  $tpl->SUBMENUTRANSACOESATIVO = "active";
  $tpl->PAGINAATUAL = "Cadastro de Transações";

  //RODAPE
  require_once(PATH."painel/includes/rodape.php");
}

$tpl->ACAO = $sOP;
$tpl->DATACADASTRO = date("Y-m-d H:i:s");

$nContador = 0;
$vIdPermissao = array();
$vWherePermissao = array("id_grupo_usuario = ".GRUPO_ADMINISTRADOR);
$voPermissao = $oFachadaSeguranca->recuperaTodosPermissao(BANCO,$vWherePermissao);

if(isset($voPermissao) && count($voPermissao) > 0){
  foreach($voPermissao as $oPermissao){
    if(isset($oPermissao) && is_object($oPermissao)){
      if(!in_array($oPermissao->getIdTipoTransacao(),$vIdPermissao))
        array_push($vIdPermissao,$oPermissao->getIdTipoTransacao());
    }
  }
}

if(isset($nIdCategoriaTipoTransacao) && $nIdCategoriaTipoTransacao != "" && $nIdCategoriaTipoTransacao != 0) {
  $oCategoriaTipoTransacao = $oFachadaSeguranca->recuperaCategoriaTipoTransacao($nIdCategoriaTipoTransacao,BANCO);
  //print_r($oCategoriaTipoTransacao);
  if(isset($oCategoriaTipoTransacao) && is_object($oCategoriaTipoTransacao)){
    $vWhereTipoTransacao = array("id_categoria_tipo_transacao = ".$nIdCategoriaTipoTransacao);
    $sOrderTipoTransacao = "transacao asc";
    $voTipoTransacao = $oFachadaSeguranca->recuperaTodosTipoTransacao(BANCO,$vWhereTipoTransacao,$sOrderTipoTransacao);
    
    $tpl->IDCATEGORIATIPOTRANSACAO = $oCategoriaTipoTransacao->getId();
    $tpl->CATEGORIATIPOTRANSACAO = utf8_decode($oCategoriaTipoTransacao->getDescricao());
    $tpl->SELECTEDTIPOTRANSACAO = "";
    if(isset($voTipoTransacao) && count($voTipoTransacao) > 0){
      foreach($voTipoTransacao as $oTipoTransacao){
        if(isset($oTipoTransacao) && is_object($oTipoTransacao)){
          $nContador++;
          $tpl->CONTADORTIPOTRANSACAO = $nContador;
          $tpl->TIPOTRANSACAO = utf8_decode($oTipoTransacao->getTransacao());
          
          $tpl->SELECTEDTIPOTRANSACAO = "";
          if(in_array($oTipoTransacao->getId(),$vIdPermissao))
            $tpl->SELECTEDTIPOTRANSACAO = "checked";
            
          $tpl->block("BLOCO_TIPO_TRANSACAO");
        }
      }
    }
    $tpl->TOTALCONTADORTIPOTRANSACAO = $nContador;
    
    if($nContador > 0){
      for($i=1;$i<=4;$i++){
        $tpl->QTD_NOVA_TRANSACAO = $i;
        $tpl->block("BLOCO_QTD_NOVA_TRANSACAO");
      }
    }
  }
}else{
  $tpl->IDCATEGORIATIPOTRANSACAO = 0;
  $tpl->TOTALCONTADORTIPOTRANSACAO = $nContador;
  $tpl->block("BLOCO_BASICO_CADASTRO");
  for($i=1;$i<=4;$i++){
    $tpl->QTD_NOVA_TRANSACAO = $i;
    $tpl->block("BLOCO_QTD_NOVA_TRANSACAO");
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