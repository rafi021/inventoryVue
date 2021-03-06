<?php

use App\Customer;
use App\Product;
use App\Salary;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            ExpenseSeeder::class,
            SalarySeeder::class,
            Customer::class,
        ]);
    }
}
