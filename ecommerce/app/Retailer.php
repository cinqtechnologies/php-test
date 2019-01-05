<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    protected $table = 'retailers';

    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany('App\Products', 'retailer_id', 'id')->orderBy('name');
    }
}
