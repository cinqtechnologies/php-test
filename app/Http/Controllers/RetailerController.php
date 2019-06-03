<?php

namespace App\Http\Controllers;

use App\Product;
use App\Retailer;
use Illuminate\Http\Request;

class RetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retailers = Retailer::all();
        return view('retailers', ['retailers' => $retailers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new-retailer');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $retailer = Retailer::find($id);
        return view('retailer', ['retailer' => $retailer, 'products' => $retailer->products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $retailer = Retailer::find($id);
        return view('new-retailer', ['retailer' => $retailer, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = false)
    {
        $validator = $request->validate([
            'name' => 'required',
            'website' => 'required'
        ]);

        if(!$validator)
        {
            return back();
        }else{
            if($id)
                $retailer = Retailer::find($id);
            else $retailer = new Retailer();

            if($request->hasFile('image'))
            {
                $retailer->image_path = $request->file('image')->store('img');
            }

            $retailer->name = $request->name;
            $retailer->description = $request->description;
            $retailer->website = $request->website;

            $retailer->save();

            return redirect()->route('retailer', ['id' => $retailer->id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
