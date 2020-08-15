<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->title(),
        'product_code' => $faker->isbn10,
        'product_description' => $faker->paragraph(),
        'product_root' => $faker->sentence(),
        'buying_price'=> $faker->numberBetween(10,10000),
        'selling_price' => $faker->numberBetween(10,10000),
        'product_quantity' => $faker->numberBetween(10,100),
        'alert_quantity' => $faker->numberBetween(1,5),
        'buying_date' => $faker->dateTime($max='now', $timezone='Asia/Dhaka'),
        'product_image' => 'default.jpg',
    ];
});
