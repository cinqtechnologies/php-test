<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\retailers;

class RetailerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retailers = retailers::all();
        
        return response()->json($retailers);
    }

    public function retailerDetail($id)
    {
        $retailers = retailers::find($id);
        
        return response()->json($retailers);
    }
    
    public function store(Request $request)
    {
        $retailer = retailers::create($request->all());
        
        return response()->json([
            'message' => 'Great success! New Retailer created',
            'product' => $retailer
        ]);
    }
    
    public function show(retailers $retailer)
    {
        return $retailer;
    }
    
    public function update(Request $request, retailers $retailer)
    {
        $retailer->update($request->all());
        
        return response()->json([
            'message' => 'Great success! Retailer updated',
            'task' => $retailer
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(retailers $retailer)
    {
        $retailer->delete();
        
        return response()->json([
            'message' => 'Successfully deleted retailer!'
        ]);
    }
}
