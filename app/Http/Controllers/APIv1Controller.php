<?php

namespace App\Http\Controllers;

use App\Product;
use App\Retailer;
use http\Env\Response;
use Illuminate\Http\Request;

class APIv1Controller extends Controller
{
    /*Create*/
    public function product_new(Request $request){
        $validator = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'retailer_id' => 'required'
        ]);

        if(!$validator)
        {
            return response()->json(['error' => "Required fields not found"], 400);
        }else{
            $product = new Product();

            if($request->hasFile('image'))
            {
                $product->image_path = $request->file('image')->store('img');
            }

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->retailer_id = $request->retailer_id;

            $product->save();

            return response()->json($product, 200);
        }
    }

    public function product_edit(Request $request, $id){
        $product = Product::find($id);

        if($product){
            if($request->hasFile('image'))
            {
                $product->image_path = $request->file('image')->store('img');
            }

            if($request->name)
                $product->name = $request->name;

            if($request->description)
                $product->description = $request->description;

            if($request->price)
                $product->price = $request->price;

            if($request->retailer_id)
                $product->retailer_id = $request->retailer_id;

            $product->save();

            return response()->json($product, 200);
        }else return response()->json(['error' => "Product not found"], 400);
    }

    public function retailer_new(Request $request){
        $validator = $request->validate([
            'name' => 'required',
            'website' => 'required'
        ]);

        if(!$validator)
        {
            return response()->json(['error' => "Required fields not found"], 400);
        }else{
            $retailer = new Retailer();

            if($request->hasFile('image'))
            {
                $retailer->image_path = $request->file('image')->store('img');
            }

            $retailer->name = $request->name;
            $retailer->description = $request->description;
            $retailer->website = $request->website;

            $retailer->save();

            return response()->json($retailer, 200);
        }
    }

    public function retailer_edit(Request $request, $id){
        $retailer = Retailer::find($id);
        if($retailer){
            if($request->hasFile('image'))
            {
                $retailer->image_path = $request->file('image')->store('img');
            }

            if(!empty($request->name))
                $retailer->name = $request->name;

            if(!empty($request->description))
                $retailer->description = $request->description;
            if(!empty($request->website))
                $retailer->website = $request->website;

            $retailer->save();

            return response()->json($retailer, 200);
        }else return response()->json(['error' => "Retailer not found"], 400);
    }

    /*List*/
    public function product($id){
        $product = Product::find($id);
        if($product){
            return response()->json($product, 200);
        }else return response()->json(['error' => "Product not found"], 400);
    }

    public function products(){
        $products = Product::all();
        if($products){
            return response()->json($products, 200);
        }else return response()->json(['error' => "Products not found"], 400);
    }

    public function retailer($id){
        $retailer = Retailer::find($id);
        if($retailer)
        {
            return response()->json($retailer, 200);
        }else return response()->json(['error' => "Retailer not found"], 400);
    }

    public function retailers(){
        $retailers = Retailer::all();
        if($retailers){
            return response()->json($retailers, 200);
        }else return response()->json(['error' => "Retailers not found"], 400);
    }


    public function retailer_products($id){
        $retailer = Retailer::find($id);
        if($retailer)
        {
            $products = $retailer->products;
            return response()->json($products, 200);
        }else return response()->json(['error' => "Retailer not found"], 400);
    }
}
