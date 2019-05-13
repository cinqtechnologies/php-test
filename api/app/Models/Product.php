<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 08/05/19
 * Time: 21:18
 */

namespace App\Models;

class Product extends BaseModel
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->rules = [
            "name" => "required",
            "price" => "required|numeric|min:0.00001",
            "retailerId" => "required|numeric|min:1",
            "description" => "required"
        ];

        $this->fillable = array_keys($this->rules);
    }

    public function retailer() {
        return $this->belongsTo('App\Models\Retailer', 'retailerId');
    }
}