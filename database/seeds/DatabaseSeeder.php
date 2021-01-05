<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductInforSeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(ImportSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(RateSeeder::class);

    }
}
