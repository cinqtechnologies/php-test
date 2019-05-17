<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\product;
use App\Models\retailers;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::all();
        $codpagina = 'prod.index';
        
        return view('products.index', ['products' => $products, 'codpagina' => $codpagina]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $retailer = retailers::all();
        
        return view('products.novo', ['retailer' => $retailer]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new product;
        $dados = $request->all();
        
        $product->Name = $request->inputName;
        $product->Price = $request->inputPrice;
        $product->Description = $request->inputDescription;
        $product->ImagePath = $dados['inputImagePath']->getClientOriginalName();
        $product->idRetailer = $request->selectRetailer;
        
        $product->save();
        
        if(isset($dados['inputImagePath'])){
            //$nomeImagem = $dados['inputLogoPath']->getClientOriginalExtension();
            
            $image_path = public_path().'/imagens/productImages/'.$dados['inputImagePath']->getClientOriginalName();
            //dd(File::delete($image_path));
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            
            $dados['inputImagePath']->move(public_path('/imagens/productImages/'), $dados['inputImagePath']->getClientOriginalName());
        }else{
            echo 'Sem arquivo apontado';
        }
        
        return redirect()->route('prod.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = product::find($id);
        $retailer = retailers::all();
        return view('products.editar', ['produto' => $produto, 'retailer' => $retailer]);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = $request->all();
        
        $produtoEditar = product::find($id);
        $produtoEditar->Name = $request->inputName;
        $produtoEditar->Price = $request->inputPrice;
        $produtoEditar->Description = $request->inputDescription;        
        $produtoEditar->idRetailer = $request->selectRetailer;
        $produtoEditar->ImagePath = $dados['inputImagePath']->getClientOriginalName();
        
        $produtoEditar->save();
        
        if(isset($dados['inputImagePath'])){
            //$nomeImagem = $dados['inputLogoPath']->getClientOriginalExtension();
            
            $image_path = public_path().'/imagens/productImages/'.$dados['inputImagePath']->getClientOriginalName();
            //dd(File::delete($image_path));
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            
            $dados['inputImagePath']->move(public_path('/imagens/productImages/'), $dados['inputImagePath']->getClientOriginalName());
        }else{
            echo 'Sem arquivo apontado';
        }
        
        return redirect()->route('prod.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::find($id);
        $product->delete();
        
        return redirect()->route('prod.index');
    }
}
