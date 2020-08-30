<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $rand = rand(1,100);
    return [
        'ar'=>['name' => 'فئة'.$rand],
        'en'=>['name' => 'category'.$rand],
    ];
});
