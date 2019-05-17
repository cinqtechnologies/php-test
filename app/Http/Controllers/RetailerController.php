<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\retailers;

class RetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retailer = retailers::all();
        
        return view('retailers.index', ['retailer' => $retailer]);
    }   
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('retailers.novo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $retailer = new retailers;
        $dados = $request->all();
        
        $retailer->Name = $request->inputName;
        $retailer->LogoPath = $dados['inputLogo']->getClientOriginalName();
        $retailer->Description = $request->inputDescription;
        $retailer->Website = $request->inputWebsite;
        
        $retailer->save();
        
        if(isset($dados['inputLogo'])){
            //$nomeImagem = $dados['inputLogoPath']->getClientOriginalExtension();
            
            $image_path = public_path().'/imagens/retailersLogo/'.$retailer->id;
            //dd(File::delete($image_path));
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            
            $dados['inputLogo']->move(public_path('/imagens/retailersLogo/'), $dados['inputLogo']->getClientOriginalName());
        }else{
            echo 'Sem arquivo apontado';
        }
        
        return redirect()->route('retail.index');
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
        $retailer = retailers::find($id);
        $retailer->delete();
        
        return redirect()->route('retail.index');
    }
}
