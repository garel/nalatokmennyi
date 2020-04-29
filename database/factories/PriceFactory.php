<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Price;
use Faker\Generator as Faker;

$factory->define(Price::class, function (Faker $faker) {
    return [
        "price" => $faker->numberBetween(1000,10000),
        "shop_id" => App\Shop::all()->random()->id,
        "product_id" =>  App\Product::all()->random()->id
    ];
});
