<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/** @mixin Eloquent */
class ProductCategory extends Model
{
    protected $casts = [
        'id' => 'integer',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
