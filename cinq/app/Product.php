<?php

namespace CINQ;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'product';

    public function retailers()
    {
        return $this->belongsTo(Retailer::class, 'retailer_id');
    }

    public function laratablesDescription()
    {
        return Str::limit($this->description, 35);
    }

    public static function laratablesModifyCollection($products)
    {
        return $products->map(function ($product) {
            $image = config('filesystems.disks.local.products') . DIRECTORY_SEPARATOR . $product->file_pic;
            $product->file_pic = file_exists($image) ? config('filesystems.disks.public.products') . DIRECTORY_SEPARATOR . $product->file_pic : "No image";
            return $product;
        });
    }

    public function laratablesRowData()
    {
        return [
            'producturl' => route('product.show', ['product' => $this->id]),
            'retailerurl' => route('retailer.show', ['retailer' => $this->retailer_id]),
        ];
    }
}
