<?php

class produtoController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
    	$array = array();
        $this->returnJson($array);
    }

    public function listarTodos(){
    	$array = array();

    	$oDadosProdutos = new Produtos();
    	$array = $oDadosProdutos->listarTodos();
    	$this->returnJson($array);
    }

    public function listarTodosPorVarejista($nIdVarejista){
        $array = array();

        $oDadosProdutos = new Produtos();
        $array = $oDadosProdutos->listarTodosPorVarejista($nIdVarejista);
        $this->returnJson($array);
    }

    public function detalhesProduto($nIdProduto){
        $array = array();

        $oDadosProdutos = new Produtos();
        $array = $oDadosProdutos->detalhes($nIdProduto);
        $this->returnJson($array);
    }

}