<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Products\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       \App\Models\User::factory(10)->create();
       Product::factory(50)->create();
    }
}
