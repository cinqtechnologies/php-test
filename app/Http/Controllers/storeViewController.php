<?php

namespace App\Http\Controllers;

use App\Models\retailers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\product;

class storeViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('storeViews.indexRetailer');
    }
    
    /**
     * Display a listing of the resource with the selected Retailer.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexWithRetailer($id){
        $retailer = retailers::find($id);
        $produtosRetailer = product::where('idRetailer', $id)->get();
        return view('storeViews.indexSelectedRetailer', ['retailer' => $retailer, 'produtos' => $produtosRetailer]);
    }

    /**
     * Display a page containing product details.
     *
     * @return \Illuminate\Http\Response
     */
    public function productDetail($id){
        $produto = product::where('id', $id)->first();
        return view('storeViews.productDetail', ['product' => $produto]);
    }
    
    /**
     * Display a message about an email sent with product details.
     *
     * @return \Illuminate\Http\Response
     */
    public function fakemail(Request $request, $id){
        Session::flash('success_msg', 'Details sent to: '.$request->email);
        $produto = product::where('id', $id)->first();
        return view('storeViews.productDetail', ['product' => $produto]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storeViews.productDetail');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
