<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'name',
        'napa_region_id',
        'postcode'
    ];

    public $timestamps = false;
}
