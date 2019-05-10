<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    public function index() {
        try {

            $products = Product::with("retailer")->get();
            return new JsonResponse($products, 200);

        } catch(\Exception $e)
        {
            Log::error($e->getTraceAsString());
            return new JsonResponse(["error" => "An error occurred while fetching the list of products"], 500);
        }
    }

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
            return new JsonResponse(["error" => "An error occurred while persisting the data"], 500);
        }
    }

    public function view(int $id) {
        try {

            $product = Product::with(["retailer"])->find($id);
            if(!$product)
            {
                return new JsonResponse(["not_found"=>"Could not find any product with the supplied id"], 404);
            }

            return new JsonResponse($product, 200);

        } catch(\Exception $e)
        {
            Log::error($e->getTraceAsString());
            return new JsonResponse(["error" => "An error occurred while loading the product's details"], 500);
        }
    }
}