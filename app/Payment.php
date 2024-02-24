<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/** @mixin Eloquent */
class Payment extends Model
{
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'order_id' => 'integer',
        'amount' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
