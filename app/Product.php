<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function retailer(){
        return $this->belongsTo('App\Retailer');
    }
}
