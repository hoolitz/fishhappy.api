<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Favorite;
use Faker\Generator as Faker;

$factory->define(Favorite::class, function (Faker $faker) {
    return [
        'customer_id' => factory(\App\Customers.id::class),
        'product_id' => factory(\App\Products.id::class),
    ];
});
