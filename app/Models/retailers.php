<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $Name
 * @property string $LogoPath
 * @property string $Description
 * @property string $Website
 * @property string $created_at
 * @property string $updated_at
 * @property Product[] $products
 */
class retailers extends Model
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
    protected $fillable = ['Name', 'LogoPath', 'Description', 'Website', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'idRetailer');
    }
}
