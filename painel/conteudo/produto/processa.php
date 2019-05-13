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
$nIdTipoTransacao = $_SESSION['oLoginAdm']->recuperaTipoTransacaoPorDescricaoCategoria("Produto",$sOP,BANCO);
$bPermissao = $_SESSION['oLoginAdm']->verificaPermissao("Produto",$sOP,BANCO);
$nIdTipoTransacao = $oFachadaSeguranca->recuperaTipoTransacaoPorDescricaoCategoria("Produto",$sOP,BANCO);

if(!$bPermissao){
	//TRANSACAO
	$bPublicadoAcesso = (isset($_POST['fPublicado']) && $_POST['fPublicado'] == 1) ? "1" : "0";
	$bAtivoAcesso = (isset($_POST['fAtivo']) && $_POST['fAtivo'] == 1) ? "1" : "0";
	
	if($sOP != "Excluir"){
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou ".$sOP." informações na gerência de produtos, porém não possui permissão para isso! Segue abaixo as informações:<br />";
		if($sOP == "Cadastrar"){
			if(isset($_POST['fIdVarejista'])){
				$oVarejistaAcesso = $oFachadaConteudo->recuperaVarejista($_POST['fIdVarejista'],BANCO);
				if(isset($oVarejistaAcesso) && is_object($oVarejistaAcesso))
					$sVarejistaAcesso = $oVarejistaAcesso->getNmVarejista();
				$sObjetoAcesso .= "Varejista: ".utf8_decode($sVarejistaAcesso)." de Id: ".$_POST['fIdVarejista']."<br />";
			}//if(isset($_POST['fIdVarejista'])){
			if(isset($_POST['fNome']))
				$sObjetoAcesso .= "Produto: ".utf8_encode($_POST['fNome'])."<br />";
			if(isset($_POST['fDescricao']))
				$sObjetoAcesso .= "Descrição: ".utf8_encode($_POST['fDescricao'])."<br />";
			if(isset($_POST['fPreco']))
				$sObjetoAcesso .= "Preço: R$ ".$_POST['fPreco']."<br />";
			if(isset($_FILES['fImagem']['name']))
				$sObjetoAcesso .= "Imagem do produto: ".$_FILES['fImagem']['name']."<br />";
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
				$oProdutoAuxiliar = $oFachadaConteudo->recuperaProduto($_POST['fIdProduto'],BANCO);
				if(is_object($oProdutoAuxiliar)){
					$oVarejistaAuxiliar = $oFachadaConteudo->recuperaVarejista($oProdutoAuxiliar->getIdVarejista(),BANCO);
					if(is_object($oVarejistaAuxiliar))
						$sVarejistaAuxiliar = utf8_decode($oVarejistaAuxiliar->getNmVarejista());
					
					$oVarejistaAuxiliarNovo = $oFachadaConteudo->recuperaVarejista($_POST['fIdVarejista'],BANCO);
					if(is_object($oVarejistaAuxiliarNovo))
						$sVarejistaAuxiliarNovo = utf8_decode($oVarejistaAuxiliarNovo->getNmVarejista());

					if($oProdutoAuxiliar->getIdVarejista() != $_POST['fIdVarejista'])
						$sObjetoAcesso .= "Varejista: ".$sVarejistaAuxiliar." de Id: ".$oProdutoAuxiliar->getIdVarejista()." --> ".$sVarejistaAuxiliarNovo." de Id: ".$_POST['fIdVarejista']."<br />";

					if($oProdutoAuxiliar->getNmProduto() != $_POST['fNome'])
						$sObjetoAcesso .= "Produto: ".utf8_decode($oProdutoAuxiliar->getNmProduto())." --> ".utf8_encode($_POST['fNome'])."<br />";
					if($oProdutoAuxiliar->getDescProduto() != $_POST['fDescricao'])
						$sObjetoAcesso .= "Descrição: ".utf8_decode($oProdutoAuxiliar->getDescProduto())." --> ".utf8_encode($_POST['fDescricao'])."<br />";
					if(number_format($oProdutoAuxiliar->getPreco(),2,',','.') != $_POST['fPreco'])
						$sObjetoAcesso .= "Preço: R$ ".number_format($oProdutoAuxiliar->getPreco(),2,',','.')." --> R$ ".$_POST['fPreco']."<br />";
					if(isset($_FILES['fImagem']['name']) && $oProdutoAuxiliar->getImagem() != $_FILES['fImagem']['name'])
						$sObjetoAcesso .= "Imagem do produto: ".$oProdutoAuxiliar->getImagem()." --> ".$_FILES['fImagem']['name']."<br />";
					if($oProdutoAuxiliar->getPublicado() != $bPublicado){
						if($oProdutoAuxiliar->getPublicado() == 1)
							$sPublicadoAtual = "Sim";
						else
							$sPublicadoAtual = "Não";
							
						if($bPublicado == 1)
							$sPublicadoNovo = "Sim";
						else
							$sPublicadoNovo = "Não";
						$sObjetoAcesso .= "Publicado: ".$sPublicadoAtual." --> ".$sPublicadoNovo."<br />";
					}//if($oProdutoAuxiliar->getPublicado() != $bPublicado){
					if($oProdutoAuxiliar->getAtivo() != $bAtivo){
						if($oProdutoAuxiliar->getAtivo() == 1)
							$sAtivoAtual = "Sim";
						else
							$sAtivoAtual = "Não";
							
						if($bAtivo == 1)
							$sAtivoNovo = "Sim";
						else
							$sAtivoNovo = "Não";
						$sObjetoAcesso .= "Ativo: ".$sAtivoAtual." --> ".$sAtivoNovo."<br />";
					}//if($oProdutoAuxiliar->getAtivo() != $bAtivo){
				}//if(is_object($oProdutoAuxiliar)){
			}//if($sOP == "Alterar"){
		}//if($sOP == "Cadastrar"){
	}else{
		$sObjetoAcesso = "VERIFICAR: Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou excluir informações da gerência de produtos, porém não possui permissão para isso! Segue abaixo as informações:<br />";
		if(count($_POST['fIdProduto']) > 0){
			foreach($_POST['fIdProduto'] as $nIdProduto) {
				if ($oFachadaConteudo->presenteProduto($nIdProduto,BANCO)){
					// TRANSACAO
					$oProdutoAuxiliarAcesso = $oFachadaConteudo->recuperaProduto($nIdProduto,BANCO);
					if(is_object($oProdutoAuxiliarAcesso)){
						$sObjetoAcesso .= "Tentou excluir o produto ".utf8_decode($oProdutoAuxiliarAcesso->getNmProduto())." de id=".$oProdutoAuxiliarAcesso->getId()."<br />";
					}//if(is_object($oProdutoAuxiliarAcesso)){
				}//if ($oFachadaSeguranca->presenteUsuario($nIdProduto,BANCO)){
			}//foreach($_POST['fIdProduto'] as $nIdProduto) {
		}else{
			$sObjetoAcesso .= "Não houve envio de ids de produtos para exclusão!???<br />";
		}//if(count($_POST['fIdProduto']) > 0){
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
	$sImagemAuxiliar = "";
	if(isset($_POST['fIdProduto']) && $_POST['fIdProduto'] != 0 && $_POST['fIdProduto'] != ""){
		$oProdutoAuxiliar = $oFachadaConteudo->recuperaProduto($_POST['fIdProduto'],BANCO);
		if(isset($oProdutoAuxiliar) && is_object($oProdutoAuxiliar)){
			$sImagemAuxiliar = $oProdutoAuxiliar->getImagem();
		}
	}
	$sImagem = $sImagemAuxiliar;

	if(isset($_FILES['fImagem']['name']) && $_FILES['fImagem']['name'] != ""){
		$vsTipoImagem = explode(".",$_FILES['fImagem']['name']);
		if($vsTipoImagem[1] == "jpg" || $vsTipoImagem[1] == "jpeg"){
			$sImagem = (isset($_FILES['fImagem']['name']) && $_FILES['fImagem']['name'] != "") ? date("YmdHis").TRIM(retira_acentos(diminuta_acentos($_FILES['fImagem']['name']))) : $sImagemAuxiliar;
		}else{
			$_SESSION['sMsg'] = "A imagem do produto precisa ser em extensão jpg ou jpeg!";
			header("Location: ".SITE."painel/conteudo/produto/insere_altera.php?sOP=$sOP&bErro=1&nIdProduto=".$_POST['fIdProduto']);
			exit();
		}
	}
	
	$oProduto = $oFachadaConteudo->inicializaProduto($_POST['fIdProduto'],$_POST['fIdVarejista'],utf8_encode($_POST['fNome']),utf8_encode($_POST['fDescricao']),str_replace(',','.',str_replace('.','',$_POST['fPreco'])),$sImagem,$_POST['fDataCadastro'],$bPublicado,$bAtivo);
	//print_r($oProduto);
	//die();
	$_SESSION['oProduto'] = $oProduto;
	
	$sAtributosChave = "nId,sImagem,bPublicado,bAtivo";
	$_SESSION['sMsg'] = $oValidacao->verificaObjetoVazio($oProduto,$sAtributosChave);
	if ($_SESSION['sMsg']){
		header("Location: ".SITE."painel/conteudo/produto/insere_altera.php?sOP=$sOP&bErro=1&nIdProduto=".$_POST['fIdProduto']);
		exit();
	}//if ($_SESSION['sMsg']){
}//if (isset($sOP) && $sOP != "Excluir"){

switch($sOP){
	case "Cadastrar":
		// TRANSACAO
		$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." efetuou o cadastro de novo produto de nome ".$_POST['fNome'];
		$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);
		$nId = $oFachadaConteudo->insereProduto($oProduto,$oTransacao,BANCO);

		//print_r($_POST);
		//print_r("ID".$nId);
		//print_r($oTransacao);
		//die();

		if (!$nId){
			$sObjetoAcesso = "VERIFICAR: Tentativa de cadastro de novo produto falhou. Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou cadastrar novo produto, porém houve erro no cadastro. Informações que seriam cadastradas: <br />";
			if(isset($_POST['fIdVarejista'])){
				$oVarejistaAcesso = $oFachadaConteudo->recuperaVarejista($_POST['fIdVarejista'],BANCO);
				if(isset($oVarejistaAcesso) && is_object($oVarejistaAcesso))
					$sVarejistaAcesso = $oVarejistaAcesso->getNmVarejista();
				$sObjetoAcesso .= "Varejista: ".utf8_decode($sVarejistaAcesso)." de Id: ".$_POST['fIdVarejista']."<br />";
			}//if(isset($_POST['fIdVarejista'])){
			if(isset($_POST['fNome']))
				$sObjetoAcesso .= "Produto: ".utf8_encode($_POST['fNome'])."<br />";
			if(isset($_POST['fDescricao']))
				$sObjetoAcesso .= "Descrição: ".utf8_encode($_POST['fDescricao'])."<br />";
			if(isset($_POST['fPreco']))
				$sObjetoAcesso .= "Preço: R$ ".$_POST['fPreco']."<br />";
			if(isset($_FILES['fImagem']['name']))
				$sObjetoAcesso .= "Imagem do produto: ".$_FILES['fImagem']['name']."<br />";

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
			$_SESSION['sMsg'] = "Não foi possível inserir o produto!";
			$sHeader = "insere_altera.php?sOP=$sOP&bErro=1";
		} else {

			//LOGO
			if(isset($_FILES['fImagem']['name']) && $_FILES['fImagem']['name'] != ""){
				$vsTipo = explode(".",$sImagem);
				if($vsTipo[1] == "jpg" || $vsTipoImagem[1] == "jpeg"){
					$sDiretorio = PATH."/painel/conteudo/produto/imagem/";
					if(isset($_FILES['fImagem']['name']) && $_FILES['fImagem']['name'] != "" && isset($sImagem) && $sImagem != "" ){
						//SALVA A IMAGEM NO DIRETORIO
						$sImagem = $_FILES['fImagem']['tmp_name'];
						$vsDiretorioDestino = array("400x400" => $sDiretorio);
						$oUpload->fazUploadArquivo($vsDiretorioDestino,$sImagem,$oProduto,"Imagem","IMAGEM");
					}//	
				}else{
					$_SESSION['sMsg'] = "A imagem do produto precisa ser em extensão jpg ou jpeg!";
					header("Location: ".SITE."painel/conteudo/produto/insere_altera.php?sOP=$sOP&bErro=1&nIdProduto=".$_POST['fIdProduto']);
					exit();
				}
			}

			$_SESSION['sMsg'] = "Produto inserido com sucesso!";
			$sHeader = "index.php?bErro=0";
			$_SESSION['oProduto'] = "";
			unset($_SESSION['oProduto']);
			unset($_POST);
		}//if (!$nId){
	break;
	case "Alterar":
		$sHeader = "insere_altera.php?sOP=$sOP&bErro=1&nIdProduto=".$_POST['fIdProduto'];
		$oProdutoAuxiliar = $oFachadaConteudo->recuperaProduto($_POST['fIdProduto'],BANCO);
		if(is_object($oProdutoAuxiliar)){
			// TRANSACAO
			$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." efetuou alteração de Informações do Produto ".utf8_decode($oProdutoAuxiliar->getNmProduto())."<br /> Modificações realizadas: <br />";
			$oVarejistaAuxiliar = $oFachadaConteudo->recuperaVarejista($oProdutoAuxiliar->getIdVarejista(),BANCO);
			if(is_object($oVarejistaAuxiliar))
				$sVarejistaAuxiliar = utf8_decode($oVarejistaAuxiliar->getNmVarejista());
			
			$oVarejistaAuxiliarNovo = $oFachadaConteudo->recuperaVarejista($_POST['fIdVarejista'],BANCO);
			if(is_object($oVarejistaAuxiliarNovo))
				$sVarejistaAuxiliarNovo = utf8_decode($oVarejistaAuxiliarNovo->getNmVarejista());

			if($oProdutoAuxiliar->getIdVarejista() != $_POST['fIdVarejista'])
				$sObjeto .= "Varejista: ".$sVarejistaAuxiliar." de Id: ".$oProdutoAuxiliar->getIdVarejista()." --> ".$sVarejistaAuxiliarNovo." de Id: ".$_POST['fIdVarejista']."<br />";

			if($oProdutoAuxiliar->getNmProduto() != $_POST['fNome'])
				$sObjeto .= "Produto: ".utf8_decode($oProdutoAuxiliar->getNmProduto())." --> ".utf8_encode($_POST['fNome'])."<br />";
			if($oProdutoAuxiliar->getDescProduto() != $_POST['fDescricao'])
				$sObjeto .= "Descrição: ".utf8_decode($oProdutoAuxiliar->getDescProduto())." --> ".utf8_encode($_POST['fDescricao'])."<br />";
			if(number_format($oProdutoAuxiliar->getPreco(),2,',','.') != $_POST['fPreco'])
				$sObjeto .= "Preço: R$ ".number_format($oProdutoAuxiliar->getPreco(),2,',','.')." --> R$ ".$_POST['fPreco']."<br />";
			if(isset($_FILES['fImagem']['name']) && $oProdutoAuxiliar->getImagem() != $_FILES['fImagem']['name'])
				$sObjeto .= "Imagem do produto: ".$oProdutoAuxiliar->getImagem()." --> ".$_FILES['fImagem']['name']."<br />";
			if($oProdutoAuxiliar->getPublicado() != $bPublicado){
				if($oProdutoAuxiliar->getPublicado() == 1)
					$sPublicadoAtual = "Sim";
				else
					$sPublicadoAtual = "Não";
					
				if($bPublicado == 1)
					$sPublicadoNovo = "Sim";
				else
					$sPublicadoNovo = "Não";
				$sObjeto .= "Publicado: ".$sPublicadoAtual." --> ".$sPublicadoNovo."<br />";
			}//if($oProdutoAuxiliar->getPublicado() != $bPublicado){
			if($oProdutoAuxiliar->getAtivo() != $bAtivo){
				if($oProdutoAuxiliar->getAtivo() == 1)
					$sAtivoAtual = "Sim";
				else
					$sAtivoAtual = "Não";
					
				if($bAtivo == 1)
					$sAtivoNovo = "Sim";
				else
					$sAtivoNovo = "Não";
				$sObjeto .= "Ativo: ".$sAtivoAtual." --> ".$sAtivoNovo."<br />";
			}//if($oProdutoAuxiliar->getAtivo() != $bAtivo){
			
			$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);

			if (!$oFachadaConteudo->alteraProduto($oProduto,$oTransacao,BANCO)){
				//TRANSACAO
				$sObjetoAcesso = "VERIFICAR: Tentativa de alteração de informações do produto ".utf8_decode($oProdutoAuxiliar->getNmProduto())." falhou. Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." tentou alterar as informações do produto ".utf8_decode($oProdutoAuxiliar->getNmProduto()).", porém houve erro na alteração. Modificações que seriam realizadas e não foram concluídas: <br />";
				$oVarejistaAuxiliar = $oFachadaConteudo->recuperaVarejista($oProdutoAuxiliar->getIdVarejista(),BANCO);
				if(is_object($oVarejistaAuxiliar))
					$sVarejistaAuxiliar = utf8_decode($oVarejistaAuxiliar->getNmVarejista());
				
				$oVarejistaAuxiliarNovo = $oFachadaConteudo->recuperaVarejista($_POST['fIdVarejista'],BANCO);
				if(is_object($oVarejistaAuxiliarNovo))
					$sVarejistaAuxiliarNovo = utf8_decode($oVarejistaAuxiliarNovo->getNmVarejista());

				if($oProdutoAuxiliar->getIdVarejista() != $_POST['fIdVarejista'])
					$sObjeto .= "Varejista: ".$sVarejistaAuxiliar." de Id: ".$oProdutoAuxiliar->getIdVarejista()." --> ".$sVarejistaAuxiliarNovo." de Id: ".$_POST['fIdVarejista']."<br />";

				if($oProdutoAuxiliar->getNmProduto() != $_POST['fNome'])
					$sObjeto .= "Produto: ".utf8_decode($oProdutoAuxiliar->getNmProduto())." --> ".utf8_encode($_POST['fNome'])."<br />";
				if($oProdutoAuxiliar->getDescProduto() != $_POST['fDescricao'])
					$sObjeto .= "Descrição: ".utf8_decode($oProdutoAuxiliar->getDescProduto())." --> ".utf8_encode($_POST['fDescricao'])."<br />";
				if(number_format($oProdutoAuxiliar->getPreco(),2,',','.') != $_POST['fPreco'])
					$sObjeto .= "Preço: R$ ".number_format($oProdutoAuxiliar->getPreco(),2,',','.')." --> R$ ".$_POST['fPreco']."<br />";
				if(isset($_FILES['fImagem']['name']) && $oProdutoAuxiliar->getImagem() != $_FILES['fImagem']['name'])
					$sObjeto .= "Imagem do produto: ".$oProdutoAuxiliar->getImagem()." --> ".$_FILES['fImagem']['name']."<br />";
				if($oProdutoAuxiliar->getPublicado() != $bPublicado){
					if($oProdutoAuxiliar->getPublicado() == 1)
						$sPublicadoAtual = "Sim";
					else
						$sPublicadoAtual = "Não";
						
					if($bPublicado == 1)
						$sPublicadoNovo = "Sim";
					else
						$sPublicadoNovo = "Não";
					$sObjetoAcesso .= "Publicado: ".$sPublicadoAtual." --> ".$sPublicadoNovo."<br />";
				}//if($oProdutoAuxiliar->getPublicado() != $bPublicado){
				if($oProdutoAuxiliar->getAtivo() != $bAtivo){
					if($oProdutoAuxiliar->getAtivo() == 1)
						$sAtivoAtual = "Sim";
					else
						$sAtivoAtual = "Não";
						
					if($bAtivo == 1)
						$sAtivoNovo = "Sim";
					else
						$sAtivoNovo = "Não";
					$sObjetoAcesso .= "Ativo: ".$sAtivoAtual." --> ".$sAtivoNovo."<br />";
				}//if($oProdutoAuxiliar->getAtivo() != $bAtivo){
				
				$oTransacaoAcesso = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjetoAcesso),IP_USUARIO,DATAHORA,1,1);
				$oFachadaSeguranca->insereTransacaoAcesso($oTransacaoAcesso,BANCO);
				$_SESSION['sMsg'] = "Não foi possível alterar o produto!";
				$sHeader = "insere_altera.php?sOP=$sOP&bErro=1&nIdProduto=".$_POST['fIdProduto'];
			} else {

				//LOGO
				if(isset($_FILES['fImagem']['name']) && $_FILES['fImagem']['name'] != ""){
					$vsTipo = explode(".",$sImagem);
					if($vsTipo[1] == "jpg" || $vsTipoImagem[1] == "jpeg"){
						$sDiretorio = PATH."/painel/conteudo/produto/imagem/";
						if(isset($_FILES['fImagem']['name']) && $_FILES['fImagem']['name'] != "" && isset($sImagem) && $sImagem != "" ){
							//SALVA A IMAGEM NO DIRETORIO
							$sImagem = $_FILES['fImagem']['tmp_name'];
							$vsDiretorioDestino = array("400x400" => $sDiretorio);
							$oUpload->fazUploadArquivo($vsDiretorioDestino,$sImagem,$oProduto,"Imagem","IMAGEM");
						}//	
					}else{
						$_SESSION['sMsg'] = "A imagem do produto precisa ser em extensão jpg ou jpeg!";
						header("Location: ".SITE."painel/conteudo/produto/insere_altera.php?sOP=$sOP&bErro=1&nIdProduto=".$_POST['fIdProduto']);
						exit();
					}
				}
				

				$_SESSION['sMsg'] = "Produto alterado com sucesso!";
				$sHeader = "index.php?bErro=0";
				$_SESSION['oProduto'] = "";
				unset($_SESSION['oProduto']);
				unset($_POST);		
			}//
		} else {
			$_SESSION['sMsg'] = "Produto não encontrado no sistema!";
		}//if(is_object($oProdutoAuxiliar)){
	break;
	case "Excluir":
		$bResultado = true;
		foreach($_POST['fIdProduto'] as $nIdProduto) {
			if ($oFachadaConteudo->presenteProduto($nIdProduto,BANCO)){
				// TRANSACAO
				$oProdutoAuxiliar = $oFachadaConteudo->recuperaProduto($nIdProduto,BANCO);				
				$sObjeto = "Usuário ".utf8_decode($_SESSION['oLoginAdm']->oUsuario->getNmUsuario())." efetuou a desativação do Produto ".utf8_decode($oProdutoAuxiliar->getNmProduto());
				$oTransacao = $oFachadaSeguranca->inicializaTransacao("",$nIdTipoTransacao,$_SESSION['oLoginAdm']->getIdUsuario(),utf8_encode($sObjeto),IP_USUARIO,DATAHORA,1,1);

				$bResultado &= $oFachadaConteudo->desativaProduto($nIdProduto,$oTransacao,BANCO);
			} else {
				$bResultado &= false;
			}//
		} //foreach($_POST['fIdProduto'] as $nIdProduto)
		
		if($bResultado){
			$_SESSION['sMsg'] = "Produto excluído com sucesso!";			
			$sHeader = "index.php?bErro=0";
		} else {
			$_SESSION['sMsg'] = "Não foi possível excluir o varejista";
			$sHeader = "index.php?bErro=1";
		}//if($bResultado){
	break;
}	
header("Location: ".SITE."painel/conteudo/produto/".$sHeader);
?>