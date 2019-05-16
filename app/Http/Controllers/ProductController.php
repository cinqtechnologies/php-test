<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        
        $product->Name = $request->inputName;
        $product->Price = $request->inputPrice;
        $product->Description = $request->inputDescription;
        $product->ImagePath = $request->inputImagePath;
        $product->idRetailer = $request->selectRetailer;
        
        $product->save();
        
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
        $produtoEditar = product::find($id);
        $produtoEditar->Name = $request->inputName;
        $produtoEditar->Price = $request->inputPrice;
        $produtoEditar->Description = $request->inputDescription;        
        $produtoEditar->idRetailer = $request->selectRetailer;
        $produtoEditar->ImagePath = $request->inputImagePath;
        
        $produtoEditar->save();
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
