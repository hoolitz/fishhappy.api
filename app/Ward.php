<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillable = [
        'name',
        'postcode',
        'napa_ward_id',
        'region_id',
        'district_id'
    ];

    public $timestamps = false;
}
