<?php
/**
 * Created by PhpStorm.
 * User: Renata
 * Date: 05/01/2019
 * Time: 23:05
 */

namespace App\Http\Services\Product;

use App\Retailer;
use App\Product;
use Illuminate\Http\Request;
use Validator;
use Image;

class CreateProductService
{
    private static function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'retailer_id' => 'required|integer',
            'name' => 'required|max:200',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|max:40000',
        ])->validate();
    }

    private static function uploadImage(Request $request)
    {
        return $request->file('image')->store(
            'products', 'public'
        );
    }

    public static function create(Request $request)
    {
        self::validate($request);

        $image = self::uploadImage($request);

        $product = new Product();
        $product->fill($request->only(['retailer_id', 'name', 'description']));
        $product->price = (float) $request->input('price');
        $product->image = $image;
        $product->save();

        return $product;
    }
}