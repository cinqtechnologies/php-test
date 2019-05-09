<?php

namespace App\Models;

class Retailer extends BaseModel
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->rules = [
            "name" => "required",
            "logo" => "required",
            "description" => "required",
            "website" => "required"
        ];
    }

    public function products() {
        return $this->hasMany('App\Product', 'retailerId');
    }
}