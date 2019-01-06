<?php
/**
 * Created by PhpStorm.
 * User: Renata
 * Date: 05/01/2019
 * Time: 17:22
 */

namespace App\Http\Services;

use App\Mail\ProductDetailsRequested;
use Illuminate\Support\Facades\Mail;
use App\Http\Services\Product\ProductDataService;
use Validator;

class EmailService
{
    public static function sendProductDetails($email, int $product_id)
    {
        Validator::make([ 'email' => $email ], [
            'email' => 'required|email'
        ])->validate();

        $product = ProductDataService::getDetails($product_id);
        Mail::to($email)->send(new ProductDetailsRequested($product));

        return true;
    }
}