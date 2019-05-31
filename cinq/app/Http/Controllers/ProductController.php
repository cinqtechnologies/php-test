<?php

namespace CINQ\Http\Controllers;

use CINQ\Product;
use CINQ\Retailer;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use CINQ\Product as ProductLaratables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        return Laratables::recordsOf(Product::class, ProductLaratables::class);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Integet  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('product', ['product' => Product::find($request->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CINQ\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CINQ\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CINQ\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  \CINQ\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function retailerProducts(Request $request)
    {
        return Product::where('retailer_id', $request->id)->get()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        $retailer = Retailer::all();
        return view('newproduct', ['retailers' => $retailer]);
    }


    public function apiListProducts(Request $request)
    {
        if(!isset($request->id)) {
            $products = Product::all();
            return response()->json(["DATA" => $products->load('retailers')->toArray(), 201]);
        } else {
            $products = Product::find($request->id);
            return response()->json(["DATA" => $products->load('retailers')->toArray(), 201]);
        }
    }

    public function tellMeWhenAvailable(Request $request)
    {
        $from = "somerandomemailtest@test.com";
        $to = $request->email;
        $subject = "You've marked this product in your wishlist";
        $message = "As soon as this product arrives you will receive a message";
        $headers = "From:" . $from;
        //mail($to,$subject,$message, $headers);
        return response()->json(["DATA" => "OK", 200]);
    }

}


