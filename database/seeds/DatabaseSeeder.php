<?php

use App\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(15)->create();
        User::factory()->admin()->create();
        User::factory(3)->employee()->create();
        Product::factory(10)->create();
        Order::factory(20)->create();
    }
}
