<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomFloat(2, 0, 999999.99),
        'size' => $faker->word,
        'weight' => $faker->randomFloat(2, 0, 999999.99),
        'weight_unit' => $faker->word,
        'description' => $faker->text,
        'category_id' => factory(\App\ProductCategories.id::class),
    ];
});
