<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    protected $fillable = [
        'name',
        'postcode',
        'napa_street_id',
        'ward_id',
        'district_id',
        'region_id',
    ];

    public $timestamps = false;
}
