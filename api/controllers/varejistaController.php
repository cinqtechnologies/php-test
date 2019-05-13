<?php
class varejistaController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
    	$array = array();
        $this->returnJson($array);
    }

    public function listarTodos(){
    	$array = array();

        $oDadosVarejistas = new Varejistas();
        $array = $oDadosVarejistas->listarTodos();
        $this->returnJson($array);
    }

    public function detalhesVarejista($nIdVarejista){
        $array = array();
        $array1 = array();
        $array2 = array();

        $oDadosVarejistas = new Varejistas();
        $array1 = (array) $oDadosVarejistas->detalhes($nIdVarejista);

        $oDadosProdutosVarejista = new Produtos();
        $array2 = (array) $oDadosProdutosVarejista->listarTodosPorVarejista($nIdVarejista);

        $array = array_merge($array1,$array2);

        $this->returnJson($array);
    }

}