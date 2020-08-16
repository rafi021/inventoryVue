<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Expense;
use Faker\Generator as Faker;

$factory->define(Expense::class, function (Faker $faker) {
    return [
        'details'=> $faker->sentence(),
        'amount' => $faker->numberBetween(100,10000),
        'expense_date' => $faker->dateTime($max='now'),
    ];
});
