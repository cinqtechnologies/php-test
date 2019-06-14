<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Retailer\{RetailerDataService, CreateRetailerService};

class RetailerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('create', 'store');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('retailer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $retailer = CreateRetailerService::create($request);

        $request->session()->flash('success', "The retailer <i>{$retailer->name}</i> was created.");
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'success' => true,
            'retailer' =>RetailerDataService::getDetails($id)
        ]);
    }
}
