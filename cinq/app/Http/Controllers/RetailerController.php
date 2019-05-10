<?php

namespace CINQ\Http\Controllers;

use CINQ\Retailer;
use Illuminate\Http\Request;
use CINQ\Product;

class RetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

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
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $retailer = Retailer::find($request->id);
        return view('retailer', ['retailer' => $retailer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CINQ\Retailer  $retailer
     * @return \Illuminate\Http\Response
     */
    public function edit(Retailer $retailer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CINQ\Retailer  $retailer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retailer $retailer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CINQ\Retailer  $retailer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retailer $retailer)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        return view('newretailer');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiListRetailer(Request $request)
    {
        if(!isset($request->id))
        {
            $retailer = Retailer::all();
            return response()->json(["DATA" => $retailer->load('products')->toArray(), 201]);
        } else {
            $retailer = Retailer::find($request->id);
            return response()->json(["DATA" => $retailer->load('products')->toArray(), 201]);
        }

    }
}
