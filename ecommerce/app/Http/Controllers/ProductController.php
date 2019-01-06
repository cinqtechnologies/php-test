<?php

namespace App\Http\Controllers;

use App\Http\Services\Retailer\RetailerDataService;
use Illuminate\Http\Request;
use App\Http\Services\Product\{ProductDataService, CreateProductService};
use App\Http\Services\EmailService;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $retailer_id = null)
    {
        $products = ProductDataService::getList($request, $retailer_id);

        return response()->json([
            'success' => true,
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create', [
            'retailers' => RetailerDataService::getList()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = CreateProductService::create($request);

        $request->session()->flash('success', "The product <i>{$product->name}</i> was created.");

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
        return view('product.showProduct', [
            'product' => ProductDataService::getDetails($id) 
        ]);
    }

    /**
     * Send product details to the user email
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendDetails(Request $request, $id)
    {
        $product = ProductDataService::getDetails($id);
        $status = EmailService::sendProductDetails($request->input('email'), $product);
        
        return response()->json([
            'success' => $status
        ]);
    }
}
