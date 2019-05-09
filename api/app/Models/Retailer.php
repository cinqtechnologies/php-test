<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 08/05/19
 * Time: 21:05
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Retailer extends BaseModel
{
    protected $fillable = [
        "name",
        "logo",
        "description",
        "website"
    ];

    public function products() {
        return $this->hasMany('App\Product', 'retailerId');
    }
}