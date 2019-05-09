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

            $data = $request->only(["name", "logo", "description", "website"]);

            if(!$retailer->validate($data))
            {
                return new JsonResponse($retailer->getErrors(), 400);
            }

//            Log::info($retailer->attributesToArray());

            $retailer->fill($data);
            $retailer->attributesToArray()
            $retailer->save();

        } catch(\Exception $e)
        {
            Log::info($e->getMessage());
        }
    }
}