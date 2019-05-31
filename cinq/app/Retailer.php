<?php

namespace CINQ;

use Illuminate\Database\Eloquent\Model;
use CINQ\Product;

class Retailer extends Model
{
    protected $table = 'retailer';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

