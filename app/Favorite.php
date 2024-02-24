<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/** @mixin Eloquent */
class Favorite extends Model
{
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'product_id' => 'integer',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
