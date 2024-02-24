<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'order_id' => factory(\App\Orders.id::class),
        'product_id' => factory(\App\Products.id::class),
        'quantity' => $faker->randomFloat(2, 0, 999999.99),
    ];
});
