<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
        'contact_name',
        'phone_number',
        'optional_phone_number',
        'number',
        'code',
        'trimedCode',
        'latitude',
        'longitude',
        'postcode',
        'customer_id',
        'region_id',
        'district_id',
        'ward_id',
        'street_id',
        'street_road_id',
    ];


}
