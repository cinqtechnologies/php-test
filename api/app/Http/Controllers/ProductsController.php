<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 08/05/19
 * Time: 23:39
 */

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    public function create(Request $request) {
        try {

            $product = new Product();

            $data = $request->only($product->getFillable());

            if(!$product->validate($data))
            {
                return new JsonResponse($product->getErrors(), 400);
            }

            $product->fill($data);
            $product->save();

            return new JsonResponse($product, 201);

        } catch(\Exception $e)
        {
            Log::error($e->getTraceAsString());
            return new JsonResponse("An error occurred while persisting the data", 500);
        }
    }
}