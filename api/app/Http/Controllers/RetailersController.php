<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RetailersController extends Controller
{
    public function create(Request $request) {
        try {

        } catch(\Exception $e)
        {
            Log::info($e->getMessage());
        }
    }
}