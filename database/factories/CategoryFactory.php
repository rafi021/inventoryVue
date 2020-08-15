<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'categoryname' => $faker->title,
        'categorydescription' => $faker->paragraph,
    ];
});
