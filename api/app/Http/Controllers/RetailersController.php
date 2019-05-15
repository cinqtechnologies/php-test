<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Lib\Image;
use App\Models\Retailer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RetailersController extends Controller
{
    public function index(Request $request) {
        try {

            $name = $request->query("name");
            $query = Retailer::query();

            if(!empty($name))
            {
                $query->where("name", "like", "%".$name."%");
            }

            $retailers = $query->get();

            return new JsonResponse($retailers, 200);

        } catch(\Exception $e)
        {
            Log::error($e->getTraceAsString());
            return new JsonResponse(["error" => "An error occurred while fetching the list of retailers"], 500);
        }
    }

    public function create(Request $request) {
        try {

            $retailer = new Retailer();

            $imageDetails = $request->get("logo");

            $data = $request->only($retailer->getFillable());

            if(!$retailer->validate($data))
            {
                return new JsonResponse($retailer->getErrors(), 400);
            }

            $imagePath = Image::store($imageDetails["value"], $imageDetails["filetype"]);

            if($imagePath)
            {
                $retailer->logo = $imagePath;
            }

            $retailer->fill($data);
            $retailer->save();

            return new JsonResponse($retailer, 201);

        } catch(\Exception $e)
        {
            Log::error($e->getMessage());
            return new JsonResponse(["error" => "An error occurred while persisting the data"], 500);
        }
    }

    public function view(int $id) {
        try {

            $retailer = Retailer::with(["products"])->find($id);
            if(!$retailer)
            {
                return new JsonResponse(["not_found" => "Could not find a retailer with the supplied id"], 404);
            }

            return new JsonResponse($retailer, 200);

        } catch(\Exception $e)
        {
            Log::error($e->getTraceAsString());
            return new JsonResponse(["error" => "An error occurred while loading the retailer's details"], 500);
        }
    }
}