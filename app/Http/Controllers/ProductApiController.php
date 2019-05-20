<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        
        return response()->json($products);
    }    

    public function productDetail($id)
    {
        $products = Product::find($id);
        
        return response()->json($products);
    }      
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'Price' => 'required',
            'Description' => 'required',
            'idRetailer' => 'required'
        ]);
        
        $product = Product::create($request->all());
        
        return response()->json([
            'message' => 'Great success! New Product created',
            'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        /* $request->validate([
            'title'       => 'nullable',
            'description' => 'nullable'
        ]); */
        
        $product->update($request->all());
        
        return response()->json([
            'message' => 'Great success! Product updated',
            'task' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        
        return response()->json([
            'message' => 'Successfully deleted task!'
        ]);
    }
}
