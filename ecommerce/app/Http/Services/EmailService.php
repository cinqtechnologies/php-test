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

class EmailService
{

    public static function sendProductDetails(string $email, \App\Product $product)
    {
        Mail::to($email)->send(new ProductDetailsRequested($product));
        return true;
    }
}