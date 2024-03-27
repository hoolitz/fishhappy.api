<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StreetRoad extends Model
{
    protected $fillable = [
        'name',
        'postcode',
        'napa_street_road_id',
        'street_id',
    ];

    public $timestamps = false;
}
