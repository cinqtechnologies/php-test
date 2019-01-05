<?php

/**
 * Created by PhpStorm.
 * User: Renata
 * Date: 05/01/2019
 * Time: 16:03
 */

namespace App\Http\Services\Retailer;

use App\Retailer;

class RetailerDataService
{
    public static function getDetails($retailer_id)
    {
        return Retailer::find($retailer_id);
    }
}