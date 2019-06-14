<?php
/**
 * Created by PhpStorm.
 * User: Renata
 * Date: 05/01/2019
 * Time: 14:48
 */

namespace App\Http\Services\Product;

use App\Product;
use Illuminate\Http\Request;

class ProductDataService{
    
    public static function getDetails($id)
    {
        return Product::with('retailer')->find($id);
    }
    
    public static function getList(Request $request, $retailer_id = null)
    {
        return Product::with('retailer')
            ->when(! empty($retailer_id), function($q) use ($retailer_id){
                $q->where('retailer_id', '=', $retailer_id);
            })
            ->orderBy('price')
            ->paginate(6);
    }
}