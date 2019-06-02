<?php

namespace App\Http\Controllers;

use App\Product;
use App\Retailer;
use Faker\Provider\Image;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view("products", ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new-product', ['retailers' => Retailer::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('product', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('new-product', ['product' => $product,'retailers' => Retailer::all(), 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = false)
    {
        $validator = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'retailer_id' => 'required'
        ]);

        if(!$validator)
        {
            return back();
        }else{
            if($id)
                $product = Product::find($id);
            else $product = new Product();

            if($request->hasFile('image'))
            {
                $product->image_path = $request->file('image')->store('img');
            }

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->retailer_id = $request->retailer_id;

            $product->save();

            return redirect()->route('product', ['id' => $product->id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
