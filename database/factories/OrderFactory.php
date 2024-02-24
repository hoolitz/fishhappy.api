<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement(["pending","cancelled","completed"]),
        'customer_id' => factory(\App\Customers.id::class),
        'confirmed_at' => $faker->dateTime(),
        'delivered_at' => $faker->dateTime(),
        'description' => $faker->text,
    ];
});
