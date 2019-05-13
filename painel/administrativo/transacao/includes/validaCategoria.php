<?php

/* RECEIVE VALUE */
//$validateValue=$_POST['validateValue'];
//$validateId=$_POST['validateId'];
//$validateError=$_POST['validateError'];

/* RECEIVE VALUE */
$validateValue= (isset($_GET['fieldValue'])) ? $_GET['fieldValue'] : ((isset($_GET['fNomeCategoria']) && $_GET['fNomeCategoria'] != "") ? $_GET['fNomeCategoria'] : "") ;
$validateId= (isset($_GET['fieldId'])) ? $_GET['fieldId'] : "fNomeCategoria" ;
$nIdCategoriaTipoTransacao = (isset($_GET['fieldIdP'])) ? $_GET['fieldIdP'] : ((isset($_GET['fIdCategoriaTipoTransacao']) && $_GET['fIdCategoriaTipoTransacao'] != "" && $_GET['fIdCategoriaTipoTransacao'] != 0) ? $_GET['fIdCategoriaTipoTransacao'] : "");

$validateError= "Categoria de Transação já existente no banco de dados, por favor escolha outro nome!";
$validateSuccess= "Categoria de Transação disponível!";
$validateSuccess2= "A Categoria de Transação continua sendo o mesmo!";

/* RETURN VALUE */
$arrayToJs = array();
$arrayToJs[0] = $validateId;
$arrayToJs[1] = $validateError;
	
require_once("../../../../constantes.php");
require_once(PATH."/classes/FachadaSegurancaBD.class.php");

$oFachadaSegurancaAux = new FachadaSegurancaBD();

$vWhereCategoriaAux = array("descricao = '".$validateValue."'");
$sOrderCategoriaAux = "";
$voCategoriaAux = $oFachadaSegurancaAux->recuperaTodosCategoriaTipoTransacao(BANCO,$vWhereCategoriaAux,$sOrderCategoriaAux);

$oCategoriaAux = $oFachadaSegurancaAux->recuperaCategoriaTipoTransacao($nIdCategoriaTipoTransacao,BANCO);
$sCategoriaAux = "";
if(is_object($oCategoriaAux)){
	$sCategoriaAux = $oCategoriaAux->getDescricao();
}

if(count($voCategoriaAux) > 0){
	if($sCategoriaAux == $voCategoriaAux[0]->getDescricao()){
		$arrayToJs[2] = "true";
		$arrayToJs[1] = $validateSuccess2;
	}else{
		$arrayToJs[2] = "false";
		$arrayToJs[1] = $validateError;
	}
}else{
	$arrayToJs[2] = "true";
	$arrayToJs[1] = $validateSuccess;
}

//echo '{"jsonValidateReturn":["'.$arrayToJs[0].'","'.$arrayToJs[1].'","'.$arrayToJs[2].'"]}';
echo '["'.$arrayToJs[0].'",'.$arrayToJs[2].',"'.$arrayToJs[1].'"]';


/*if($validateValue =="karnius"){		// validate??
	$arrayToJs[2] = "true";			// RETURN TRUE
	echo '{"jsonValidateReturn":'.json_encode($arrayToJs).'}';			// RETURN ARRAY WITH success
}else{
	for($x=0;$x<1000000;$x++){
		if($x == 990000){
			$arrayToJs[2] = "false";
			echo '{"jsonValidateReturn":'.json_encode($arrayToJs).'}';		// RETURN ARRAY WITH ERROR
		}
	}
}*/

?>