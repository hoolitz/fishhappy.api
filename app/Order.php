<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/** @mixin \Eloquent */
class Order extends Model
{
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
    ];

    protected $dates = [
        'confirmed_at',
        'delivered_at',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')->withPivot("quantity");
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
