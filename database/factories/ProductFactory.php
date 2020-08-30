<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $rand = rand(1,100);
    return [
        'ar'=>['name' => 'منتج'.$rand],
        'en'=>['name' => 'product'.$rand],
        'purchase_price' => rand(1,20),
        'sale_price' => rand(22,40),
        'stock' => rand(50,200),

    ];
});
