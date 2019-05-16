<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $Name
 * @property float $Price
 * @property string $ImagePath
 * @property string $Description
 * @property integer $idRetailer
 * @property string $created_at
 * @property string $updated_at
 * @property Retailer $retailer
 */
class product extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['Name', 'Price', 'ImagePath', 'Description', 'idRetailer', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function retailer()
    {
        return $this->belongsTo('App\Models\Retailers', 'idRetailer');
    }
}
