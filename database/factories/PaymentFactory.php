<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'customer_id' => factory(\App\Customers.id::class),
        'order_id' => factory(\App\Orders.id::class),
        'transaction_id' => $faker->word,
        'tracking_id' => $faker->word,
        'status' => $faker->word,
        'payment_method' => $faker->word,
        'amount' => $faker->randomFloat(2, 0, 999999.99),
    ];
});
