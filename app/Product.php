<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

/** @mixin Eloquent */
class Product extends Model
{

    protected $fillable = [
        'imageUrl',
        'imageSize',
        'imageType',
        'name',
        'price',
        'size',
        'weight',
        'weight_unit',
        'description',
        'category_id'
    ];

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

    public static function validate($input, $id = null)
    {
        $rules = [ # place-holder for validation rules
            'image' => ['required', 'image','mimes:jpeg,png,jpg','max:2048',],
            'name' => ['required'],
            'price' => ['required','numeric'],
            'weight' => ['required','numeric'],
            'size' => ['nullable'],
            'weight_unit' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
        ];

        $messages = [
            'weight.required' => 'Weight is required.',
            'weight.numeric' => 'Weight must be a numeric value.',
            'weight.min' => 'Weight must be at least 0.',
        ];

        $nice_names = [ # Friendly names
            'category_id' => 'Category',
            'weight_unit' => 'Weight Unit',
        ];

        # validation code
        $validator = Validator::make($input, $rules,$messages);
        $validator->setAttributeNames($nice_names);

        return $validator;
    }


}
