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
            "price" => "required",
            "image" => "required",
            "retailerId" => "required",
            "description" => "required"
        ];

        $this->fillable = array_keys($this->rules);
    }

    public function retailer() {
        return $this->belongsTo('App\Models\Retailer', 'retailerId');
    }
}