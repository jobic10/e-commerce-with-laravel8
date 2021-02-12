<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(10)->create();
        \App\Models\Cart::factory(10)->create();
        \App\Models\Sale::factory(10)->create();
        \App\Models\Detail::factory(10)->create();
        \App\Models\Transaction::factory(3)->create();
    }
}