<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/** @mixin Eloquent */
class Product extends Model
{
    protected $appends = ["is_favourite"];

    protected $casts = [
        'id' => 'integer',
        'price' => 'decimal:2',
        'weight' => 'decimal:2',
        'category_id' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Customer::class, "favorites");
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function getIsFavouriteAttribute()
    {
        return $this->favorites()->when(auth("api")->check(), function ($query){
            $query->where("customer_id", auth("api")->id());
        })->exists();
    }
}
