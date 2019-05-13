<?php

namespace App\Models;

class Retailer extends BaseModel
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->rules = [
            "name" => "required",
            "description" => "required",
            "website" => "required"
        ];

        $this->fillable = array_keys($this->rules);
    }

    public function products() {
        return $this->hasMany('App\Models\Product', 'retailerId');
    }
}