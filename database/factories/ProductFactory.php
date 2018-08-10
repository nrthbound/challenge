<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'id' => 20,
        'name' => 'Fake Product Name',
        'description' => 'This is a fake product!',
        'price' => 4.25
    ];
});
