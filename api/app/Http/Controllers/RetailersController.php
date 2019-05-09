<?php

namespace App\Http\Controllers;

use App\Models\Retailer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RetailersController extends Controller
{
    public function create(Request $request) {
        try {

            $retailer = new Retailer();

            $data = $request->only($retailer->getFillable());

            if(!$retailer->validate($data))
            {
                return new JsonResponse($retailer->getErrors(), 400);
            }

            $retailer->fill($data);
            $retailer->save();

            return new JsonResponse($retailer, 201);

        } catch(\Exception $e)
        {
            Log::info($e->getMessage());
            return new JsonResponse("An error occurred while persisting the data", 500);
        }
    }
}