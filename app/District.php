<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'napa_region_id',
        'region_id',
        'napa_district_id',
        'name',
        'postcode'
    ];
}
