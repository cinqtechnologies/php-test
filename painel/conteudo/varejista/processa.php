<?php
require_once("../../../constantes.php");
require_once(PATH."/painel/includes/valida_usuario.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");
require_once(PATH."/classes/FachadaConteudoBD.class.php");
require_once(PATH."/classes/Validacao.class.php");
require_once(PATH."/classes/Upload.class.php");
require_once(PATH."/classes/Funcoes.class.php");

$oFachadaSeguranca = new FachadaSegurancaBD();
$oFachadaConteudo = new FachadaConteudoBD();
$oValidacao = new Validacao();
$oUpload = new Upload();

//print_r($_POST);
//print_r($_FILES);
//die();

// VERIFICA AS PERMISSÕES
$sOP = (isset($_POST['sOP'])) ? $_POST['sOP'] : "";
$nIdTipoTransacao = $_SESSION['oLoginAdm']->recuperaTipoTransacaoPorDescricaoCategoria("Varejista",$sOP,BANCO);
$bPermissao = $_SESSION['oLoginAdm']->verificaPermissao("Varejista",$sOP,BANCO);
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Varejista",$sOP,BANCO);

if(!$bPermissao){
	//TRANSACAO
	$bPublicadoAcesso = (isset($_POST['fPublicado']) && $_POST['fPublicado'] == 1) ? "1" : "0";
	$bAtivoAcesso = (isset($_POST['fAtivo']) && $_POST['fAtivo'] == 1) ? "1" : "0";
	
	if($sOP != "Excluir"){
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou ".$sOP." informações na gerência de varejistas, porém não possui permissão para isso! Segue abaixo as informações:<br />";
		if($sOP == "Cadastrar"){
			if(isset($_POST['fNome']))
				$sObjetoAcesso .= "Varejista: ".utf8_encode($_POST['fNome'])."<br />";
			if(isset($_POST['fDescricao']))
				$sObjetoAcesso .= "Descrição: ".utf8_encode($_POST['fDescricao'])."<br />";
			if(isset($_POST['fSite']))
				$sObjetoAcesso .= "Website: ".utf8_encode($_POST['fSite'])."<br />";
			if(isset($_FILES['fLogo']['name']))
				$sObjetoAcesso .= "Logo: ".$_FILES['fLogo']['name']."<br />";
			if(isset($bPublicadoAcesso)){
				if($bPublicadoAcesso == 1)
					$sPublicadoAcesso = "Sim";
				else
					$sPublicadoAcesso = "Não";
				$sObjetoAcesso .= "Publicado: ".$sPublicadoAcesso."<br />";
			}//if(isset($bPublicadoAcesso)){
			if(isset($bAtivoAcesso)){
				if($bAtivoAcesso == 1)
					$sAtivoAcesso = "Sim";
				else
					$sAtivoAcesso = "Não";
				$sObjetoAcesso .= "Ativo: ".$sAtivoAcesso."<br />";
			}//if(isset($bAtivoAcesso)){
		}else{
			if($sOP == "Alterar"){
				$oVarejistaAuxiliar = $oFachadaConteudo->recuperaVarejista($_POST['fIdVarejista'],BANCO);
				if(is_object($oVarejistaAuxiliar)){
					if($oVarejistaAuxiliar->getNmVarejista() != $_POST['fNome'])
						$sObjetoAcesso .= "Varejista: ".utf8_decode($oVarejistaAuxiliar->getNmVarejista())." --> ".utf8_encode($_POST['fNome'])."<br />";
					if($oVarejistaAuxiliar->getDescVarejista() != $_POST['fDescricao'])
						$sObjetoAcesso .= "Descrição: ".utf8_decode($oVarejistaAuxiliar->getDescVarejista())." --> ".utf8_encode($_POST['fDescricao'])."<br />";
					if($oVarejistaAuxiliar->getSite() != $_POST['fSite'])
						$sObjetoAcesso .= "Website: ".$oVarejistaAuxiliar->getSite()." --> ".$_POST['fSite']."<br />";
					if(isset($_FILES['fLogo']['name']) && $oVarejistaAuxiliar->getLogo() != $_FILES['fLogo']['name'])
						$sObjetoAcesso .= "Logo: ".$oVarejistaAuxiliar->getLogo()." --> ".$_FILES['fLogo']['name']."<br />";
					if($oVarejistaAuxiliar->getPublicado() != $bPublicado){
						if($oVarejistaAuxiliar->getPublicado() == 1)
							$sPublicadoAtual = "Sim";
						else
							$sPublicadoAtual = "Não";
							
						if($bPublicado == 1)
							$sPublicadoNovo = "Sim";
						else
							$sPublicadoNovo = "Não";
						$sObjetoAcesso .= "Publicado: ".$sPublicadoAtual." --> ".$sPublicadoNovo."<br />";
					}//if($oVarejistaAuxiliar->getPublicado() != $bPublicado){
					if($oVarejistaAuxiliar->getAtivo() != $bAtivo){
						if($oVarejistaAuxiliar->getAtivo() == 1)
							$sAtivoAtual = "Sim";
						else
							$sAtivoAtual = "Não";
							
						if($bAtivo == 1)
							$sAtivoNovo = "Sim";
						else
							$sAtivoNovo = "Não";
						$sObjetoAcesso .= "Ativo: ".$sAtivoAtual." --> ".$sAtivoNovo."<br />";
					}//if($oVarejistaAuxiliar->getAtivo() != $bAtivo){
				}//if(is_object($oVarejistaAuxiliar)){
			}//if($sOP == "Alterar"){
		}//if($sOP == "Cadastrar"){
	}else{
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou excluir informações da gerência de varejistas, porém não possui permissão para isso! Segue abaixo as informações:<br />";
		if(count($_POST['fIdVarejista']) > 0){
			foreach($_POST['fIdVarejista'] as $nIdVarejista) {
				if ($oFachadaConteudo->presenteVarejista($nIdVarejista,BANCO)){
					// TRANSACAO
					$oVarejistaAuxiliarAcesso = $oFachadaConteudo->recuperaVarejista($nIdVarejista,BANCO);
					if(is_object($oVarejistaAuxiliarAcesso)){
						$sObjetoAcesso .= "Tentou excluir o varejista ".utf8_decode($oVarejistaAuxiliarAcesso->getNmVarejista())." de id=".$oVarejistaAuxiliarAcesso->getId()."<br />";
					}//if(is_object($oVarejistaAuxiliarAcesso)){
				}//if ($oFachadaSeguranca->presenteUsuario($nIdVarejista,BANCO)){
			}//foreach($_POST['fIdVarejista'] as $nIdVarejista) {
		}else{
			$sObjetoAcesso .= "Não houve envio de ids de varejistas para exclusão!???<br />";
		}//if(count($_POST['fIdVarejista']) > 0){
	}//if($sOP != "Excluir"){
	
	$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacaoAcesso("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
	$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
	$_SESSION['sMsgPermissao'] = ACESSO_NEGADO;
	header("location: ".SITE."painel/index.php?bErro=1");
	exit();
}//if(!$bPermissao){

// REGISTRANDO NA SESSÃO
if (isset($sOP) && $sOP != "Excluir"){
	$bPublicado = (isset($_POST['fPublicado']) && $_POST['fPublicado'] == 1) ? "1" : "0";
	$bAtivo = (isset($_POST['fAtivo']) && $_POST['fAtivo'] == 1) ? "1" : "0";
	$sLogoAuxiliar = "";
	if(isset($_POST['fIdVarejista']) && $_POST['fIdVarejista'] != 0 && $_POST['fIdVarejista'] != ""){
		$oVarejistaAuxiliar = $oFachadaConteudo->recuperaVarejista($_POST['fIdVarejista'],BANCO);
		if(isset($oVarejistaAuxiliar) && is_object($oVarejistaAuxiliar)){
			$sLogoAuxiliar = $oVarejistaAuxiliar->getLogo();
		}
	}
	$vsTipoLogo = explode(".",$_FILES['fLogo']['name']);
	if($vsTipoLogo[1] == "jpg" || $vsTipoLogo[1] == "jpeg"){
		$sLogo = (isset($_FILES['fLogo']['name']) && $_FILES['fLogo']['name'] != "") ? date("YmdHis").TRIM(retira_acentos(diminuta_acentos($_FILES['fLogo']['name']))) : $sLogoAuxiliar;
	}else{
		$_SESSION['sMsg'] = "A imagem da logo precisa ser em extensão jpg ou jpeg!";
		header("Location: ".SITE."painel/conteudo/varejista/insere_altera.php?sOP=$sOP&bErro=1&nIdVarejista=".$_POST['fIdVarejista']);
		exit();
	}
	
	$oVarejista = $oFachadaConteudo->inicializaVarejista($_POST['fIdVarejista'],utf8_encode($_POST['fNome']),utf8_encode($_POST['fDescricao']),$_POST['fSite'],$sLogo,$_POST['fDataCadastro'],$bPublicado,$bAtivo);
	//print_r($oVarejista);
	//die();
	$_SESSION['oVarejista'] = $oVarejista;
	
	$sAtributosChave = "nId,sSite,sLogo,bPublicado,bAtivo";
	$_SESSION['sMsg'] = $oValidacao->verificaObjetoVazio($oVarejista,$sAtributosChave);
	if ($_SESSION['sMsg']){
		header("Location: ".SITE."painel/conteudo/varejista/insere_altera.php?sOP=$sOP&bErro=1&nIdVarejista=".$_POST['fIdVarejista']);
		exit();
	}//if ($_SESSION['sMsg']){
}//if (isset($sOP) && $sOP != "Excluir"){

switch($sOP){
	case "Cadastrar":
		// TRANSACAO
		$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." efetuou o cadastro de novo varejista de nome ".$_POST['fNome'];
		$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);
		$nId = $oFachadaConteudo->insereVarejista($oVarejista,$oTransacao,BANCO);

		//print_r($_POST);
		//print_r("ID".$nId);
		//print_r($oTransacao);
		//die();

		if (!$nId){
			$sObjetoAcesso = "VERIFICAR: Tentativa de cadastro de novo varejista falhou. Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou cadastrar novo varejista, porém houve erro no cadastro. Informações que seriam cadastradas: <br />";
			if(isset($_POST['fNome']) && $_POST['fNome'] != "")
				$sObjetoAcesso .= "Varejista: ".utf8_encode($_POST['fNome'])."<br />";
			if(isset($_POST['fDescricao']) && $_POST['fDescricao'] != "")
				$sObjetoAcesso .= "Descrição: ".utf8_encode($_POST['fDescricao'])."<br />";
			if(isset($_POST['fSite']) && $_POST['fSite'] != "")
				$sObjetoAcesso .= "Website: ".utf8_encode($_POST['fSite'])."<br />";
			if(isset($_FILES['fLogo']['name']) && $_FILES['fLogo']['name'] != "")
				$sObjetoAcesso .= "Logo: ".$_FILES['fLogo']['name']."<br />";

			if($bPublicado == 1)
				$sPublicadoNovo = "Sim";
			else
				$sPublicadoNovo = "Não";
			$sObjetoAcesso .= "Publicado: ".$sPublicadoNovo."<br />";

			if($bAtivo == 1)
				$sAtivoNovo = "Sim";
			else
				$sAtivoNovo = "Não";
			$sObjetoAcesso .= "Ativo: ".$sAtivoNovo."<br />";
				
			$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
			$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
			$_SESSION['sMsg'] = "Não foi possível inserir o varejista!";
			$sHeader = "insere_altera.php?sOP=$sOP&bErro=1";
		} else {

			//LOGO
			if(isset($_FILES['fLogo']['name']) && $_FILES['fLogo']['name'] != ""){
				$vsTipo = explode(".",$sLogo);
				if($vsTipo[1] == "jpg" || $vsTipoLogo[1] == "jpeg"){
					$sDiretorio = PATH."/painel/conteudo/varejista/logo/";
					if(isset($_FILES['fLogo']['name']) && $_FILES['fLogo']['name'] != "" && isset($sLogo) && $sLogo != "" ){
						//SALVA A IMAGEM NO DIRETORIO
						$sImagem = $_FILES['fLogo']['tmp_name'];
						$vsDiretorioDestino = array("400x400" => $sDiretorio);
						$oUpload->fazUploadArquivo($vsDiretorioDestino,$sImagem,$oVarejista,"Logo","IMAGEM");
					}//	
				}else{
					$_SESSION['sMsg'] = "A imagem da logo precisa ser em extensão jpg ou jpeg!";
					header("Location: ".SITE."painel/conteudo/varejista/insere_altera.php?sOP=$sOP&bErro=1&nIdVarejista=".$_POST['fIdVarejista']);
					exit();
				}
			}

			$_SESSION['sMsg'] = "Varejista inserido com sucesso!";
			$sHeader = "index.php?bErro=0";
			$_SESSION['oVarejista'] = "";
			unset($_SESSION['oVarejista']);
			unset($_POST);
		}//if (!$nId){
	break;
	case "Alterar":
		$sHeader = "insere_altera.php?sOP=$sOP&bErro=1&nIdVarejista=".$_POST['fIdVarejista'];
		$oVarejistaAuxiliar = $oFachadaConteudo->recuperaVarejista($_POST['fIdVarejista'],BANCO);
		if(is_object($oVarejistaAuxiliar)){
			// TRANSACAO
			$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." efetuou alteração de Informações do Varejista ".utf8_decode($oVarejistaAuxiliar->getNmVarejista())."<br /> Modificações realizadas: <br />";
			if($oVarejistaAuxiliar->getNmVarejista() != $_POST['fNome'])
				$sObjeto .= "Varejista: ".utf8_decode($oVarejistaAuxiliar->getNmVarejista())." --> ".$_POST['fNome']."<br />";
			if($oVarejistaAuxiliar->getDescVarejista() != $_POST['fDescricao'])
				$sObjeto .= "Descrição: ".utf8_decode($oVarejistaAuxiliar->getDescVarejista())." --> ".$_POST['fDescricao']."<br />";
			if($oVarejistaAuxiliar->getSite() != $_POST['fSite'])
				$sObjeto .= "Website: ".$oVarejistaAuxiliar->getSite()." --> ".$_POST['fSite']."<br />";
			if(isset($_FILES['fLogo']['name']) && $oVarejistaAuxiliar->getLogo() != $_FILES['fLogo']['name'])
				$sObjeto .= "Logo: ".$oVarejistaAuxiliar->getLogo()." --> ".$_FILES['fLogo']['name']."<br />";
			if($oVarejistaAuxiliar->getPublicado() != $bPublicado){
				if($oVarejistaAuxiliar->getPublicado() == 1)
					$sPublicadoAtual = "Sim";
				else
					$sPublicadoAtual = "Não";
					
				if($bPublicado == 1)
					$sPublicadoNovo = "Sim";
				else
					$sPublicadoNovo = "Não";
				$sObjeto .= "Publicado: ".$sPublicadoAtual." --> ".$sPublicadoNovo."<br />";
			}//if($oVarejistaAuxiliar->getPublicado() != $bPublicado){
			if($oVarejistaAuxiliar->getAtivo() != $bAtivo){
				if($oVarejistaAuxiliar->getAtivo() == 1)
					$sAtivoAtual = "Sim";
				else
					$sAtivoAtual = "Não";
					
				if($bAtivo == 1)
					$sAtivoNovo = "Sim";
				else
					$sAtivoNovo = "Não";
				$sObjeto .= "Ativo: ".$sAtivoAtual." --> ".$sAtivoNovo."<br />";
			}//if($oVarejistaAuxiliar->getAtivo() != $bAtivo){
			
			$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);

			if (!$oFachadaConteudo->alteraVarejista($oVarejista,$oTransacao,BANCO)){
				//TRANSACAO
				$sObjetoAcesso = "VERIFICAR: Tentativa de alteração de informações do varejista ".utf8_decode($oVarejistaAuxiliar->getNmVarejista())." falhou. Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar as informações do varejista ".utf8_decode($oVarejistaAuxiliar->getNmVarejista()).", porém houve erro na alteração. Modificações que seriam realizadas e não foram concluídas: <br />";
				if($oVarejistaAuxiliar->getNmVarejista() != $_POST['fNome'])
					$sObjetoAcesso .= "Varejista: ".utf8_decode($oVarejistaAuxiliar->getNmVarejista())." --> ".utf8_encode($_POST['fNome'])."<br />";
				if($oVarejistaAuxiliar->getDescVarejista() != $_POST['fDescricao'])
					$sObjetoAcesso .= "Descrição: ".utf8_decode($oVarejistaAuxiliar->getDescVarejista())." --> ".utf8_encode($_POST['fDescricao'])."<br />";
				if($oVarejistaAuxiliar->getSite() != $_POST['fSite'])
					$sObjetoAcesso .= "Website: ".$oVarejistaAuxiliar->getSite()." --> ".$_POST['fSite']."<br />";
				if(isset($_FILES['fLogo']['name']) && $oVarejistaAuxiliar->getLogo() != $_FILES['fLogo']['name'])
					$sObjetoAcesso .= "Logo: ".$oVarejistaAuxiliar->getLogo()." --> ".$_FILES['fLogo']['name']."<br />";
				if($oVarejistaAuxiliar->getPublicado() != $bPublicado){
					if($oVarejistaAuxiliar->getPublicado() == 1)
						$sPublicadoAtual = "Sim";
					else
						$sPublicadoAtual = "Não";
						
					if($bPublicado == 1)
						$sPublicadoNovo = "Sim";
					else
						$sPublicadoNovo = "Não";
					$sObjetoAcesso .= "Publicado: ".$sPublicadoAtual." --> ".$sPublicadoNovo."<br />";
				}//if($oVarejistaAuxiliar->getPublicado() != $bPublicado){
				if($oVarejistaAuxiliar->getAtivo() != $bAtivo){
					if($oVarejistaAuxiliar->getAtivo() == 1)
						$sAtivoAtual = "Sim";
					else
						$sAtivoAtual = "Não";
						
					if($bAtivo == 1)
						$sAtivoNovo = "Sim";
					else
						$sAtivoNovo = "Não";
					$sObjetoAcesso .= "Ativo: ".$sAtivoAtual." --> ".$sAtivoNovo."<br />";
				}//if($oVarejistaAuxiliar->getAtivo() != $bAtivo){
				
				$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
				$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
				$_SESSION['sMsg'] = "Não foi possível alterar o varejista!";
				$sHeader = "insere_altera.php?sOP=$sOP&bErro=1&nIdVarejista=".$_POST['fIdVarejista'];
			} else {

				//LOGO
				if(isset($_FILES['fLogo']['name']) && $_FILES['fLogo']['name'] != ""){
					$vsTipo = explode(".",$sLogo);
					if($vsTipo[1] == "jpg" || $vsTipoLogo[1] == "jpeg"){
						$sDiretorio = PATH."/painel/conteudo/varejista/logo/";
						if(isset($_FILES['fLogo']['name']) && $_FILES['fLogo']['name'] != "" && isset($sLogo) && $sLogo != "" ){
							//SALVA A IMAGEM NO DIRETORIO
							$sImagem = $_FILES['fLogo']['tmp_name'];
							$vsDiretorioDestino = array("400x400" => $sDiretorio);
							$oUpload->fazUploadArquivo($vsDiretorioDestino,$sImagem,$oVarejista,"Logo","IMAGEM");
						}//	
					}else{
						$_SESSION['sMsg'] = "A imagem da logo precisa ser em extensão jpg ou jpeg!";
						header("Location: ".SITE."painel/conteudo/varejista/insere_altera.php?sOP=$sOP&bErro=1&nIdVarejista=".$_POST['fIdVarejista']);
						exit();
					}
				}
				

				$_SESSION['sMsg'] = "Varejista alterado com sucesso!";
				$sHeader = "index.php?bErro=0";
				$_SESSION['oVarejista'] = "";
				unset($_SESSION['oVarejista']);
				unset($_POST);		
			}//
		} else {
			$_SESSION['sMsg'] = "Varejista não encontrado no sistema!";
		}//if(is_object($oVarejistaAuxiliar)){
	break;
	case "Excluir":
		$bResultado = true;
		foreach($_POST['fIdVarejista'] as $nIdVarejista) {
			if ($oFachadaConteudo->presenteVarejista($nIdVarejista,BANCO)){
				// TRANSACAO
				$oVarejistaAuxiliar = $oFachadaConteudo->recuperaVarejista($nIdVarejista,BANCO);				
				$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." efetuou a desativação do Varejista ".utf8_decode($oVarejistaAuxiliar->getNmVarejista());
				$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);

				$bResultado &= $oFachadaConteudo->desativaVarejista($nIdVarejista,$oTransacao,BANCO);
			} else {
				$bResultado &= false;
			}//
		} //foreach($_POST['fIdVarejista'] as $nIdVarejista)
		
		if($bResultado){
			$_SESSION['sMsg'] = "Varejista excluído com sucesso!";			
			$sHeader = "index.php?bErro=0";
		} else {
			$_SESSION['sMsg'] = "Não foi possível excluir o varejista";
			$sHeader = "index.php?bErro=1";
		}//if($bResultado){
	break;
}	
header("Location: ".SITE."painel/conteudo/varejista/".$sHeader);
?>