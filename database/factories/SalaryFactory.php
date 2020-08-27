<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use App\Salary;
use Faker\Generator as Faker;

$factory->define(Salary::class, function (Faker $faker) {
    return [
        'employee_id' => $faker->numberBetween(1, Employee::count()),
        'amount' => $faker->numberBetween(10000, 100000),
        'salary_date' => $faker->dateTime($max='now'),
        'salary_month' => $faker->dateTime($max='now'),
        'salary_year' => $faker->dateTime($max='now'),
    ];
});
