<?php

namespace App;

use Eloquent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/** @mixin Eloquent */
class Customer extends Authenticatable
{
    use HasApiTokens;

    use Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'device_id',
    ];

    protected $hidden = ['password'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, "favorites");
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public static function validate($input, $id = null)
    {
        $rules = [
            # place-holder for customer validation rules
            'name' => ['required', 'min:2', 'max:50'],
            'phone' => ['required'],
            'email' => ["required", "email", Rule::unique("customers", "email")],
            'password' => ['required'],
        ];

        $nice_names = [ # Friendly names
        ];

        # validation code
        $validator = Validator::make($input, $rules);
        $validator->setAttributeNames($nice_names);

        return $validator;
    }

}
