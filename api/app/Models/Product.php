<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 08/05/19
 * Time: 21:18
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel
{
    protected $fillable = [
        "name",
        "price",
        "image",
        "retailerId",
        "description"
    ];

    public function retailer() {
        return $this->belongsTo('App\Models\Retailer', 'retailerId');
    }
}